<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class MailTemplateController extends Controller
{
    public function index()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::find(Session::get('LoggedIn'));
            $mailTemplates = MailTemplate::paginate(10); // Paginate for better UX

            return view('admin.mail-templates.index', compact('mailTemplates', 'user_session'));
        }

        return redirect('login')->with('warning', 'Please log in to access this page.');
    }

    public function add()
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::find(Session::get('LoggedIn'));
            return view('admin.mail-templates.add', compact('user_session'));
        }

        return redirect('login')->with('warning', 'Please log in to access this page.');
    }

    public function save(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'alias' => 'required|string|max:255|unique:mail_templates',
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required',
            'shortcodes' => 'nullable|json', // Ensure valid JSON input
            // 'status' => 'nullable|boolean',
        ]);

        try {
            // Convert shortcodes to JSON if it's a valid string
            $validated['shortcodes'] = json_decode($request->input('shortcodes'), true);

            // Handle checkbox for status
            $validated['status'] = $request->has('status') ? 1 : 0;

            // Save the validated data to the database
            MailTemplate::create($validated);

            return back()->with('success', 'Template created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error saving MailTemplate: ' . $e->getMessage());
            return back()->with('fail', 'Error creating template: ' . $e->getMessage());
        }
    }



    public function edit($id)
    {
        if (Session::has('LoggedIn')) {
            $user_session = User::find(Session::get('LoggedIn'));
            $mailTemplate = MailTemplate::findOrFail($id);

            return view('admin.mail-templates.edit', compact('mailTemplate', 'user_session'));
        }

        return redirect('login')->with('warning', 'Please log in to access this page.');
    }

    public function update(Request $request, $id)
{
    // Validate input data
    $validated = $request->validate([
        'alias' => "required|string|max:255|unique:mail_templates,alias,$id",
        'name' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'body' => 'required',
        'shortcodes' => 'nullable|json', // Ensure valid JSON input
        // 'status' => 'nullable|boolean',  // Handle checkbox input
    ]);

    try {
        // Convert shortcodes to JSON if it's a valid string
        if ($request->has('shortcodes')) {
            $validated['shortcodes'] = json_decode($request->input('shortcodes'), true);
        }

        // Handle checkbox for status
        $validated['status'] = $request->has('status') ? true : false;

        // Find the existing MailTemplate
        $mailTemplate = MailTemplate::findOrFail($id);

        // Update the MailTemplate with validated data
        $mailTemplate->update($validated);

        return back()->with('success', 'Template updated successfully.');
    } catch (\Exception $e) {
        \Log::error('Error updating MailTemplate: ' . $e->getMessage());
        return back()->with('fail', 'Error updating template: ' . $e->getMessage());
    }
}


    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No templates selected.']);
        }

        try {
            MailTemplate::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Templates deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting templates.']);
        }
    }
}
