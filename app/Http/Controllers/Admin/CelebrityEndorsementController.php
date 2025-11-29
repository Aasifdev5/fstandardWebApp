<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CelebrityEndorsement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CelebrityEndorsementController extends Controller
{
    // ==================== LIST ALL ====================
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('Userlogin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));

        $endorsements = CelebrityEndorsement::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.celebrity-endorsements.index', compact('endorsements', 'user_session'));
    }

    // ==================== STORE NEW ====================
    public function store(Request $request)
    {
        if (!Session::has('LoggedIn')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'name'       => 'required|string|max:100',
            'role'       => 'required|string|max:100',
            'quote'      => 'required|string|max:500',
            'youtube_id' => 'required|string|size:11',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->only(['name', 'role', 'quote', 'youtube_id']);

        // ========== IMAGE UPLOAD ==========
        if ($request->hasFile('image')) {

            $destination = 'celebrities';
            $file = $request->file('image');

            $uploadPath = public_path('uploads/' . $destination);

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file_name = time() . '-' . \Str::random(10) . '.' . $file->getClientOriginalExtension();

            $file->move($uploadPath, $file_name);

            $data['image'] = 'uploads/' . $destination . '/' . $file_name;
        }

        CelebrityEndorsement::create($data);

        return response()->json(['success' => true, 'message' => 'Celebrity endorsement added successfully!']);
    }

    // ==================== EDIT FORM DATA ====================
    public function edit($id)
    {
        if (!Session::has('LoggedIn')) {
            return response()->json(['success' => false], 401);
        }

        $endorsement = CelebrityEndorsement::findOrFail($id);
        return response()->json($endorsement);
    }

    // ==================== UPDATE ====================
    public function update(Request $request, $id)
    {
        if (!Session::has('LoggedIn')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $endorsement = CelebrityEndorsement::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:100',
            'role'       => 'required|string|max:100',
            'quote'      => 'required|string|max:500',
            'youtube_id' => 'required|string|size:11',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->only(['name', 'role', 'quote', 'youtube_id']);

        // ========== NEW IMAGE UPLOAD ==========
        if ($request->hasFile('image')) {

            // Delete old image from public/uploads
            if ($endorsement->image && file_exists(public_path($endorsement->image))) {
                unlink(public_path($endorsement->image));
            }

            $destination = 'celebrities';
            $file = $request->file('image');

            $uploadPath = public_path('uploads/' . $destination);

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file_name = time() . '-' . \Str::random(10) . '.' . $file->getClientOriginalExtension();

            $file->move($uploadPath, $file_name);

            $data['image'] = 'uploads/' . $destination . '/' . $file_name;
        }

        $endorsement->update($data);

        return response()->json(['success' => true, 'message' => 'Updated successfully!']);
    }

    // ==================== DELETE ====================
    public function destroy($id)
    {
        if (!Session::has('LoggedIn')) {
            return response()->json(['success' => false], 401);
        }

        $endorsement = CelebrityEndorsement::findOrFail($id);

        // Delete old image from public/uploads
        if ($endorsement->image && file_exists(public_path($endorsement->image))) {
            unlink(public_path($endorsement->image));
        }

        $endorsement->delete();

        return response()->json(['success' => true, 'message' => 'Deleted successfully!']);
    }

    // ==================== TOGGLE ACTIVE/INACTIVE ====================
    public function toggle($id)
    {
        if (!Session::has('LoggedIn')) {
            return response()->json(['success' => false], 401);
        }

        $endorsement = CelebrityEndorsement::findOrFail($id);
        $endorsement->update(['is_active' => !$endorsement->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $endorsement->is_active,
            'message' => $endorsement->is_active ? 'Activated' : 'Deactivated'
        ]);
    }
}
