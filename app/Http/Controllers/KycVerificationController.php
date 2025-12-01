<?php
// app/Http/Controllers/KycVerificationController.php

namespace App\Http\Controllers;

use App\Models\KycVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KycVerificationController extends Controller
{
    /**
     * Display KYC status page
     */
    private function authenticatedUser()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('/login')->with('fail', 'You must be logged in first.');
        }

        $user_session = User::where('id', Session::get('LoggedIn'))->first();

        if (!$user_session) {
            Session::forget('LoggedIn');
            return redirect('/login')->with('fail', 'Session expired. Please login again.');
        }

        return $user_session;
    }
    public function kyc()
    {
        $user = $this->authenticatedUser();
        $user_session = $this->authenticatedUser();
        if ($user instanceof \Illuminate\Http\RedirectResponse) return $user_session;
        $kyc = $user->kycVerification;
        // dd($kyc);
        return view('kyc', compact('user_session', 'kyc'));
    }

    /**
     * Show KYC form
     */
    public function create()
    {
        $user = Auth::user();
        $kyc = $user->kycVerification ?? new KycVerification();

        // Pre-fill user data if KYC not exists
        if (!$kyc->exists) {
            $kyc->first_name = $user->first_name;
            $kyc->last_name = $user->last_name;
            $kyc->email = $user->email;
            $kyc->mobile_number = $user->phone;
        }

        return view('kyc.create', compact('kyc'));
    }

    /**
     * Store KYC data
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if KYC already submitted
        $existingKyc = $user->kycVerification;
        if ($existingKyc && $existingKyc->isApproved()) {
            return redirect()->route('kyc.index')
                ->with('error', 'Your KYC is already approved.');
        }

        $validator = Validator::make($request->all(), $this->getValidationRules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Handle file uploads
        $data = $this->handleFileUploads($request, $data);

        // Set user IP
        $data['submission_ip'] = $request->ip();

        // If same as permanent address
        if ($request->has('same_as_permanent') && $request->same_as_permanent) {
            $data['correspondence_address'] = $data['permanent_address'];
            $data['correspondence_city'] = $data['permanent_city'];
            $data['correspondence_state'] = $data['permanent_state'];
            $data['correspondence_pincode'] = $data['permanent_pincode'];
            $data['same_as_permanent'] = true;
        }

        // Create or update KYC
        if ($existingKyc) {
            $existingKyc->update(array_merge($data, [
                'status' => KycVerification::STATUS_SUBMITTED,
                'submitted_at' => now(),
            ]));
            $kyc = $existingKyc;
        } else {
            $kyc = $user->kycVerification()->create(array_merge($data, [
                'status' => KycVerification::STATUS_SUBMITTED,
                'submitted_at' => now(),
            ]));
        }

        // Generate trading account if KYC is auto-approved
        if ($this->shouldAutoApprove($kyc)) {
            $this->autoApproveKyc($kyc);

            return redirect()->route('kyc')
                ->with('success', 'KYC submitted and auto-approved! Your trading account has been created.');
        }

        return redirect()->route('kyc')
            ->with('success', 'KYC submitted successfully! It will be reviewed within 24-48 hours.');
    }

    /**
     * Show KYC details
     */
    public function show(KycVerification $kyc)
    {
        $user_session = $this->authenticatedUser();

        return view('admin.kyc.show', compact('kyc', 'user_session'));
    }

    /**
     * Download KYC document
     */
    public function downloadDocument($type, KycVerification $kyc)
    {
        $documentPath = match ($type) {
            'pan'            => $kyc->pan_card_path,
            'aadhaar_front'  => $kyc->aadhaar_front_path,
            'aadhaar_back'   => $kyc->aadhaar_back_path,
            'photo'          => $kyc->passport_photo_path,
            'signature'      => $kyc->signature_path,
            'cheque'         => $kyc->cancelled_cheque_path,
            'address'        => $kyc->address_proof_path,
            'income'         => $kyc->income_proof_path,
            default          => null,
        };

        if (!$documentPath) {
            abort(404, 'Document not found.');
        }

        // Full physical path
        $fullPath = public_path($documentPath);

        if (!file_exists($fullPath)) {
            abort(404, 'File not found.');
        }

        return response()->download($fullPath);
    }


    /**
     * Get validation rules
     */
    private function getValidationRules(): array
    {
        return [
            // Personal Information
            'pan_number' => 'required|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/',
            'aadhaar_number' => 'required|digits:12',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date|before:18 years ago',
            'gender' => 'required|in:male,female,other',
            'father_name' => 'required|string|max:200',
            'mother_name' => 'nullable|string|max:200',

            // Contact Details
            'mobile_number' => 'required|digits:10',
            'email' => 'required|email',
            'alternate_contact' => 'nullable|digits:10',

            // Permanent Address
            'permanent_address' => 'required|string|max:500',
            'permanent_city' => 'required|string|max:100',
            'permanent_state' => 'required|string|max:100',
            'permanent_pincode' => 'required|digits:6',

            // Correspondence Address
            'same_as_permanent' => 'boolean',
            'correspondence_address' => 'required_if:same_as_permanent,false|nullable|string|max:500',
            'correspondence_city' => 'required_if:same_as_permanent,false|nullable|string|max:100',
            'correspondence_state' => 'required_if:same_as_permanent,false|nullable|string|max:100',
            'correspondence_pincode' => 'required_if:same_as_permanent,false|nullable|digits:6',

            // Bank Details
            'bank_name' => 'required|string|max:200',
            'account_number' => 'required|digits_between:9,18',
            'account_holder_name' => 'required|string|max:200',
            // 'ifsc_code' => 'required|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
            'branch_name' => 'required|string|max:200',
            'bank_address' => 'required|string|max:500',

            // Financial Information
            'occupation_type' => 'required|in:salaried,business,professional,housewife,student,retired,other',
            'company_name' => 'required_if:occupation_type,salaried,business,professional|nullable|string|max:200',
            'designation' => 'nullable|string|max:100',
            'annual_income' => 'required|numeric|min:0',
            'income_source' => 'required|in:salary,business,investments,pension,other',

            // Document Uploads
            'pan_card' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'aadhaar_front' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'aadhaar_back' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport_photo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'cancelled_cheque' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'address_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'income_proof' => 'required_if:occupation_type,salaried,business,professional|nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Risk Profile
            'risk_appetite' => 'required|in:low,moderate,high',
            'investment_experience' => 'required|in:beginner,intermediate,expert',
            'investment_objectives' => 'nullable|string|max:1000',

            // Compliance
            'politically_exposed' => 'boolean',
            'us_citizen' => 'boolean',
            'agree_terms' => 'required|accepted',
            'agree_declaration' => 'required|accepted',
        ];
    }

    /**
     * Handle file uploads
     */
    private function handleFileUploads(Request $request, array $data): array
    {
        $userId = Auth::id();
        $uploadPath = "kyc/documents/{$userId}";

        $fileFields = [
            'pan_card' => 'pan_card_path',
            'aadhaar_front' => 'aadhaar_front_path',
            'aadhaar_back' => 'aadhaar_back_path',
            'passport_photo' => 'passport_photo_path',
            'signature' => 'signature_path',
            'cancelled_cheque' => 'cancelled_cheque_path',
            'address_proof' => 'address_proof_path',
            'income_proof' => 'income_proof_path',
        ];

        foreach ($fileFields as $requestField => $dbField) {

            if ($request->hasFile($requestField)) {

                $attribute = $request->file($requestField);

                $destination = $uploadPath;
                $fullPath = public_path('uploads/' . $destination);

                // Make folder if missing
                if (!file_exists($fullPath)) {
                    mkdir($fullPath, 0755, true);
                }

                // Delete old file if update
                if (!empty($data[$dbField]) && file_exists(public_path($data[$dbField]))) {
                    unlink(public_path($data[$dbField]));
                }

                // Generate unique filename
                $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();

                // Move file
                $attribute->move($fullPath, $file_name);

                // Save new file path
                $data[$dbField] = 'uploads/' . $destination . '/' . $file_name;
            }
        }

        return $data;
    }


    /**
     * Check if KYC should be auto-approved
     */
    private function shouldAutoApprove(KycVerification $kyc): bool
    {
        // Simple auto-approval logic - can be customized
        return $kyc->annual_income > 500000
            && $kyc->risk_appetite !== 'high'
            && !$kyc->politically_exposed
            && !$kyc->us_citizen;
    }

    /**
     * Auto-approve KYC and generate trading account
     */
    private function autoApproveKyc(KycVerification $kyc): void
    {
        // Generate unique account numbers
        $kyc->update([
            'status' => KycVerification::STATUS_APPROVED,
            'verified_at' => now(),
            'verified_by' => 1, // Admin user ID
            'demat_account_number' => 'DEMAT' . str_pad($kyc->user_id, 8, '0', STR_PAD_LEFT),
            'trading_account_number' => 'TRADING' . str_pad($kyc->user_id, 8, '0', STR_PAD_LEFT),
            'dp_id' => 'DP' . str_pad(rand(1000, 9999), 6, '0', STR_PAD_LEFT),
            'client_id' => 'CLIENT' . str_pad($kyc->user_id, 8, '0', STR_PAD_LEFT),
        ]);

        // Update user KYC status
        $kyc->user->update([
            'kyc_verified' => true,
            'kyc_verified_at' => now(),
        ]);
    }
    /**
     * Admin: List all KYC applications
     */
    public function adminIndex(Request $request)
    {
        $user_session = $this->authenticatedUser();

        $query = KycVerification::with('user');

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('pan_number', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('username', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Date range filter
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('submitted_at', [
                $request->from_date . ' 00:00:00',
                $request->to_date . ' 23:59:59'
            ]);
        }

        $kycs = $query->latest()->paginate(20);

        $stats = [
            'total' => KycVerification::count(),
            'pending' => KycVerification::where('status', 'submitted')->count(),
            'approved' => KycVerification::where('status', 'approved')->count(),
            'rejected' => KycVerification::where('status', 'rejected')->count(),
        ];

        return view('admin.kyc.index', compact('kycs', 'stats', 'user_session'));
    }

    /**
     * Admin: Approve KYC
     */
    public function approve(Request $request, $id)
    {
        $kyc = KycVerification::findOrFail($id);
        // $this->authorize('approve', $kyc);

        // Generate unique account numbers
        $kyc->update([
            'status' => KycVerification::STATUS_APPROVED,
            'verified_at' => now(),
            'verified_by' => Auth::id(),
            'demat_account_number' => 'DEM' . date('Ymd') . str_pad($kyc->user_id, 6, '0', STR_PAD_LEFT),
            'trading_account_number' => 'TRD' . date('Ymd') . str_pad($kyc->user_id, 6, '0', STR_PAD_LEFT),
            'dp_id' => 'DP' . str_pad(rand(1000, 9999), 6, '0', STR_PAD_LEFT),
            'client_id' => 'CL' . date('ym') . str_pad($kyc->user_id, 5, '0', STR_PAD_LEFT),
            'remarks' => $request->remarks,
        ]);

        // Update user KYC status
        $kyc->user->update([
            'kyc_verified' => true,
            'kyc_verified_at' => now(),
            'kyc_status' => 'approved',
        ]);

        // Send notification to user
        // Notification::send($kyc->user, new KycApprovedNotification($kyc));

        return response()->json([
            'success' => true,
            'message' => 'KYC approved successfully',
            'data' => $kyc
        ]);
    }

    /**
     * Admin: Reject KYC
     */
    public function reject(Request $request, $id)
    {
        $kyc = KycVerification::findOrFail($id);
        // $this->authorize('reject', $kyc);

        $request->validate([
            'rejection_reason' => 'required|string|min:10|max:500'
        ]);

        $kyc->update([
            'status' => KycVerification::STATUS_REJECTED,
            'rejected_at' => now(),
            'rejected_by' => Auth::id(),
            'rejection_reason' => $request->rejection_reason,
            'remarks' => $request->remarks,
        ]);

        // Update user KYC status
        $kyc->user->update([
            'kyc_verified' => false,
            'kyc_status' => 'rejected',
        ]);

        // Send notification to user
        // Notification::send($kyc->user, new KycRejectedNotification($kyc));

        return response()->json([
            'success' => true,
            'message' => 'KYC rejected successfully',
            'data' => $kyc
        ]);
    }

    /**
     * Admin: Bulk actions
     */
    public function bulkAction(Request $request)
    {
        // $this->authorize('bulkAction', KycVerification::class);

        $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:kyc_verifications,id'
        ]);

        $count = 0;

        switch ($request->action) {
            case 'approve':
                foreach ($request->ids as $id) {
                    $kyc = KycVerification::find($id);
                    if (Gate::allows('approve', $kyc)) {
                        $kyc->update([
                            'status' => KycVerification::STATUS_APPROVED,
                            'verified_at' => now(),
                            'verified_by' => Auth::id(),
                        ]);
                        $kyc->user->update(['kyc_verified' => true]);
                        $count++;
                    }
                }
                break;

            case 'reject':
                foreach ($request->ids as $id) {
                    $kyc = KycVerification::find($id);
                    if (Gate::allows('reject', $kyc)) {
                        $kyc->update([
                            'status' => KycVerification::STATUS_REJECTED,
                            'rejected_at' => now(),
                            'rejected_by' => Auth::id(),
                            'rejection_reason' => 'Bulk rejection',
                        ]);
                        $count++;
                    }
                }
                break;

            case 'delete':
                foreach ($request->ids as $id) {
                    $kyc = KycVerification::find($id);
                    if (Gate::allows('delete', $kyc)) {
                        // Delete associated files
                        $fileFields = [
                            'pan_card_path',
                            'aadhaar_front_path',
                            'aadhaar_back_path',
                            'passport_photo_path',
                            'signature_path',
                            'cancelled_cheque_path',
                            'address_proof_path',
                            'income_proof_path'
                        ];

                        foreach ($fileFields as $field) {
                            $filePath = $kyc->$field; // e.g. uploads/kyc/documents/5/file.png

                            if ($filePath && file_exists(public_path($filePath))) {
                                unlink(public_path($filePath));
                            }
                        }

                        $kyc->delete();
                        $count++;
                    }
                }
                break;
        }

        return response()->json([
            'success' => true,
            'message' => "{$count} KYC(s) {$request->action}d successfully"
        ]);
    }

    /**
     * Export KYC data
     */
    public function export(Request $request)
    {
        // $this->authorize('export', KycVerification::class);

        $kycs = KycVerification::with('user')
            ->when($request->status, fn($q, $status) => $q->where('status', $status))
            ->when($request->from_date && $request->to_date, function ($q) use ($request) {
                $q->whereBetween('submitted_at', [$request->from_date, $request->to_date]);
            })
            ->latest()
            ->get();

        $fileName = 'kyc_applications_' . date('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($kycs) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");

            // Headers
            fputcsv($file, [
                'ID',
                'User ID',
                'Name',
                'PAN',
                'Aadhaar',
                'Mobile',
                'Email',
                'Status',
                'Occupation',
                'Annual Income',
                'Submitted At',
                'Verified At',
                'Verified By',
                'Trading Account',
                'Demat Account'
            ]);

            // Data
            foreach ($kycs as $kyc) {
                fputcsv($file, [
                    $kyc->id,
                    $kyc->user_id,
                    $kyc->first_name . ' ' . $kyc->last_name,
                    $kyc->pan_number,
                    $kyc->aadhaar_number,
                    $kyc->mobile_number,
                    $kyc->email,
                    ucfirst($kyc->status),
                    ucfirst($kyc->occupation_type),
                    '₹' . number_format($kyc->annual_income),
                    $kyc->submitted_at->format('d M Y H:i'),
                    $kyc->verified_at ? $kyc->verified_at->format('d M Y H:i') : '-',
                    $kyc->verified_by ? 'Admin #' . $kyc->verified_by : '-',
                    $kyc->trading_account_number ?? '-',
                    $kyc->demat_account_number ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
