<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Page;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComposeMail;
use Illuminate\Support\Str;

class Pages extends Controller
{
    public function pages_list()
    {

        if (Session::has('LoggedIn')) {
            $pages_list = Page::orderBy('id')->paginate(10);

            $page_title = trans('words.pages');
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.pages_list', compact('user_session', 'page_title', 'pages_list'));
        }
    }

    public function add()
    {
        if (Session::has('LoggedIn')) {

            $page_title = trans('add_page');
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.addedit_page', compact('user_session', 'page_title'));
        }
    }

    public function edit($page_id)
    {
        if (Session::has('LoggedIn')) {
            $page_title = trans('words.edit_page');

            $page_info = Page::findOrFail($page_id);
            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            return view('admin.addedit_page', compact('user_session', 'page_title', 'page_info'));
        }
    }
    public function get_page($slug)
    {


            $user_session = User::where('id', Session::get('LoggedIn'))->first();

            $page_info = Page::where('page_slug', $slug)->first();
            $pages=Page::all();
            if ($page_info->id == 5) {
                $pages=Page::all();
                return view('admin.pages.pages_contact', compact('user_session', 'pages','page_info'));
            } else {
                return view('admin.pages.pages', compact('user_session','pages', 'page_info'));
            }

    }

    public function contact_send(Request $request)
{
    // dd($request->phone);
    // Validate input fields
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    // Extract validated data
    $name = $validatedData['name'];
    $email = $validatedData['email'];
    $message_content = $validatedData['message'];

    // Prepare data for the email
    $data = [
        'name' => $name,
        'email' => $email,
        'phone'=>$request->phone,
        'subject'=>$request->subject,
        'message_content' => $message_content,

    ];

    try {
        // Send email using the ContactFormSubmitted Mailable
        Mail::to('admin@lajoyaresort.com.bo')->send(new ContactFormSubmitted($data));

        // Flash success message and redirect back
        \Session::flash('flash_message', 'Gracias. Su mensaje ha sido enviado.');
        return \Redirect::back();
    } catch (\Throwable $e) {
        // Log error and flash error message
        \Log::error('No se pudo enviar el correo electrónico del formulario de contacto: ' . $e->getMessage());
        \Session::flash('error_flash_message', 'No se pudo enviar su mensaje. Por favor, inténtelo de nuevo más tarde.');
        return \Redirect::back()->withErrors(['error' => 'No se pudo enviar el correo electrónico.']);
    }
}


    public function addnew(Request $request)
    {
// dd($request->all());

        $inputs = $request->all();

        if (!empty($inputs['id'])) {

            $page_obj = Page::findOrFail($inputs['id']);
        } else {

            $page_obj = new Page;
        }


        $page_slug = Str::slug($inputs['page_title'], '-');

        $page_obj->page_title = addslashes($inputs['page_title']);
        $page_obj->page_slug = $page_slug;
        $page_obj->page_content = addslashes($inputs['page_content']);

        $page_obj->page_order = $inputs['page_order'];
        $page_obj->status = $inputs['status'];

        $data = $page_obj->save();
        if ($data) {
            return back()->with('success', 'Added Successfully');
        } else {
            return back()->with('fail', 'Failed');
        }
    }

    public function delete($page_id)
    {
        $page_obj = Page::findOrFail($page_id);
        $page_obj->delete();
        return response()->json(['success' => true, 'message' => 'Deleted Successfully']);
    }


    public function page_details($page_slug, $page_id)
    {
        $page_info = Page::findOrFail($page_id);



        $page_title = $page_info->page_title;


        return view('page_details', compact('page_title', 'page_info'));
    }
    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids');

    if ($ids && count($ids) > 0) {
        Page::whereIn('id', $ids)->delete();
        return response()->json(['success' => true, 'message' => 'Páginas eliminadas exitosamente.']);
    } else {
        return response()->json(['success' => false, 'message' => 'No se seleccionaron registros para eliminar.']);
    }
}

}
