<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForumCategoryController extends Controller
{
    use General, ImageSaveTrait;

    protected $model;

    public function __construct(ForumCategory $category)
    {
        $this->model = new Crud($category);
    }

    public function index()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = __('Manage Forum Category');
            $data['navForumActiveClass'] = "mm-active";
            $data['subNavForumCategoryIndexActiveClass'] = "mm-active";
            $data['forumCategories'] = ForumCategory::all();
            return view('admin.forum.category-list', $data);
        }
        return redirect()->route('login')->withErrors(__('Please login to access this page.'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:forum_categories,title',
            'subtitle' => 'required',
            'logo' => 'nullable|mimes:png|file|max:1024|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
        ]);

        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'slug' => $this->generateSlug($request->title),
            'status' => $request->status ?? 0,
            'logo' => $request->logo ? $this->saveImage('forumCategory', $request->logo, null, null) : null
        ];

        $this->model->create($data);

        // Use with() to flash success message
        return redirect()->back()->with('success', __('Category created successfully.'));
    }

    public function update(Request $request, $uuid)
    {
        $forumCategory = $this->model->getRecordByUuid($uuid);
        $request->validate([
            'title' => 'required|unique:forum_categories,title,' . $forumCategory->id,
            'subtitle' => 'required',
            'logo' => 'nullable|mimes:png|file|max:1024|dimensions:min_width=60,min_height=60,max_width=60,max_height=60'
        ]);

        $logo = $forumCategory->logo;

        if ($request->hasFile('logo')) {
            $this->deleteFile($forumCategory->logo);
            $logo = $this->saveImage('forumCategory', $request->logo, null, null);
        }

        $slug = $this->generateUniqueSlug($request->title, $uuid);

        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'status' => $request->status ?? 0,
            'logo' => $logo,
            'slug' => $slug
        ];

        $this->model->updateByUuid($data, $uuid);

        // Use with() to flash success message
        return redirect()->back()->with('success', __('Category updated successfully.'));
    }

    public function delete($uuid)
    {
        $forumCategory = $this->model->getRecordByUuid($uuid);
        $this->deleteFile($forumCategory->logo); // Delete associated logo
        $this->model->deleteByUuid($uuid);

        // Use with() to flash error message
        return redirect()->back()->with('error', __('Category has been deleted.'));
    }

    private function generateSlug($title)
    {
        return Str::slug($title);
    }

    private function generateUniqueSlug($title, $uuid)
    {
        $slug = $this->generateSlug($title);
        if (ForumCategory::where('slug', $slug)->where('uuid', '!=', $uuid)->exists()) {
            $slug = $slug . '-' . rand(100000, 999999);
        }
        return $slug;
    }
}
