<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MediaController extends Controller
{

    public function index()
    {
        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Manage Media';
            $data['media'] = Media::all();
            return view('admin.gallery.index', $data);
        }
    }

    public function create()
    {

        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Add Media';
            return view('admin.gallery.create', $data);
        }
    }

    public function store(Request $request)
{

    $request->validate([
        'title' => 'required|string|max:255',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $media = new Media();
    $media->title = $request->title;

    if ($request->hasFile('thumbnail')) {
        $image = $request->file('thumbnail');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/product_images');
        $image->move($destinationPath, $name);
        $media->thumbnail = '/product_images/' . $name;
    }

    if ($media->save()) {
        return response()->json(['success' => true, 'message' => 'Medios añadidos con éxito']);
    } else {
        return response()->json(['success' => false, 'message' => 'No se pudo agregar el medio']);
    }
}

    public function edit($id)
    {

        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Edit Media';
            $data['media'] = Media::find($id);
            return view('admin.gallery.edit', $data);
        }
    }

    public function update(Request $request, $id)
    {
       $request->validate([
        'title' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $media = Media::findOrFail($id);
    $media->title = $request->title;

    if ($request->hasFile('thumbnail')) {
        // Delete the old image if it exists
        if ($media->thumbnail && file_exists(public_path($media->thumbnail))) {
            unlink(public_path($media->thumbnail));
        }

        $image = $request->file('thumbnail');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/product_images');
        $image->move($destinationPath, $name);
        $media->thumbnail = '/product_images/' . $name;
    }

    if ($media->save()) {
        return response()->json(['success' => true, 'message' => 'Medios actualizados con éxito']);
    } else {
        return response()->json(['success' => false, 'message' => 'No se pudo actualizar el medio']);
    }
    }

    public function delete($id)
    {
        $media =  Media::find($id);

        if (!$media) {
            return response()->json(['success' => false, 'message' => 'Medio no encontrado.'], 404);
        }

        $media->delete();

        return back();
    }
    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids');
    if (is_array($ids) && count($ids) > 0) {
        Media::whereIn('id', $ids)->delete();
        return response()->json(['success' => true, 'message' => 'Medios eliminados exitosamente.']);
    }

    return response()->json(['success' => false, 'message' => 'No se seleccionaron medios.']);
}

}
