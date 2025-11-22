<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogTag;
use App\Models\Tag;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use App\Traits\SendNotification;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use General, ImageSaveTrait, SendNotification;

    protected $model;
    public function __construct(Blog $blog)
    {
        $this->model = new Crud($blog);
    }
    public function incrementLike($id)
    {
        // Find the blog by ID
        $blog = Blog::find($id);

        if ($blog) {
            // Increment the like count
            $blog->increment('like_count');

            return response()->json([
                'success' => true,
                'like_count' => $blog->like_count
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function index()
    {
        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Manage Blog';
            $data['blogs'] = Blog::all();
            return view('admin.blog.index', $data);
        }
    }

    public function create()
    {

        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Create Blog';
            $data['blogCategories'] = BlogCategory::all();
            $data['tags'] = Tag::all();
            return view('admin.blog.create', $data);
        }
    }

    public function store(BlogRequest $request)
    {
        // Check if the requested slug already exists
        if (Blog::where('slug', $request->slug)->count() > 0) {
            $slug = $request->slug . '-' . rand(100000, 999999);
        } else {
            $slug = $request->slug;
        }



        if ($request->hasFile('image')) {

            // Handle new image upload
            $attribute = $request->file('image');
            $destination = 'blog';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update image path
            $image = 'uploads/' . $destination . '/' . $file_name;
        }
        // Initialize data array with blog details
        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'user_id' => $request->user_id, // Assuming user_id is provided in the request
            'short_description' => $request->short_description,
            'details' => $request->details,
            'image' => $image,
            'blog_category_id' => $request->blog_category_id,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];
        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $attribute = $request->file('og_image');
            $destination = 'meta';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update og_image path
            $data['og_image'] = 'uploads/' . $destination . '/' . $file_name;
        }

        // Create the blog record
        $blog = Blog::create($data);
        $text = 'A new blog has posted on the platform.';
        $target_url = url('blog_details', ['slug' => $slug]);
        $this->sendForApi($text, 2, $target_url, $request->user_id, $request->user_id);
        // Attach tags to the blog if provided
        if ($request->tag_ids) {
            foreach ($request->tag_ids as $tag_id) {
                $blogTag = new BlogTag();
                $blogTag->blog_id = $blog->id;
                $blogTag->tag_id = $tag_id;
                $blogTag->save();
            }
        }

        // Redirect to appropriate route
        return back()->with('success', 'Blog created successfully.');
    }


    public function edit($uuid)
    {
        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Edit Blog';
            $data['blog'] = $this->model->getRecordByUuid($uuid);
            $data['blogTags'] = $data['blog']->tags->pluck('tag_id')->toArray();
            $data['blogCategories'] = BlogCategory::all();
            $data['tags'] = Tag::all();
            return view('admin.blog.edit', $data);
        }
    }

    public function update(BlogRequest $request, $uuid)
    {
        $blog = $this->model->getRecordByUuid($uuid);

        $image = $blog->image;

        if ($request->hasFile('image')) {
            // Delete old image file
            $this->deleteFile($blog->image);

            // Handle new image upload
            $attribute = $request->file('image');
            $destination = 'blog';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update image path
            $image = 'uploads/' . $destination . '/' . $file_name;
        }

        // Check if slug needs to be updated
        $slug = ($request->slug !== $blog->slug && Blog::where('slug', $request->slug)->where('uuid', '!=', $uuid)->count() > 0) ?
            $request->slug . '-' . rand(100000, 999999) :
            $request->slug;

        $data = [
            'title' => $request->title,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'details' => $request->details,
            'blog_category_id' => $request->blog_category_id,
            'image' => $image,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ];

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $attribute = $request->file('og_image');
            $destination = 'meta';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update og_image path
            $data['og_image'] = 'uploads/' . $destination . '/' . $file_name;
        }

        // Update the blog record
        $this->model->updateByUuid($data, $uuid);

        // Attach tags to the blog if provided
        if ($request->tag_ids) {
            BlogTag::where('blog_id', $blog->id)->delete();
            foreach ($request->tag_ids as $tag_id) {
                $blogTag = new BlogTag();
                $blogTag->blog_id = $blog->id;
                $blogTag->tag_id = $tag_id;
                $blogTag->save();
            }
        }

        return back()->with('success', 'Updated');
    }

    public function delete($uuid)
    {

        $blog = $this->model->getRecordByUuid($uuid);
        BlogTag::where('blog_id', $blog->id)->delete();
        $this->deleteFile($blog->image); // delete file from server
        $this->model->deleteByUuid($uuid); // delete record


        return redirect()->back()->with('Blog has been deleted');
    }

    public function blogCommentList()
    {
        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = ' Blog Comments';
            $data['navBlogParentActiveClass'] = 'mm-active';
            $data['subNavBlogCommentListActiveClass'] = 'mm-active';

            $data['comments'] = BlogComment::paginate(25);
            return view('admin.blog.comment-list', $data);
        }
    }

    public function changeBlogCommentStatus(Request $request)
    {


        $comment = BlogComment::findOrFail($request->id);
        $comment->status = $request->status;
        $comment->save();

        return response()->json([
            'data' => 'success',
        ]);
    }

    public function blogCommentDelete($id)
    {

        $comment = BlogComment::findOrFail($id);
        BlogComment::where('parent_id', $id)->delete();
        $comment->delete();


        return redirect()->back()->with('Blog has been deleted');
    }
    public function bulkDeleteComments(Request $request)
    {
        $ids = $request->input('selected_ids');

        // Validate that IDs were provided
        if (empty($ids)) {
            return response()->json(['message' => 'No comments selected for deletion.'], 400);
        }

        // Perform the deletion
        BlogComment::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Selected comments have been deleted successfully.']);
    }

    public function bulkDelete(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        if ($selectedIds) {
            Blog::whereIn('uuid', $selectedIds)->delete();
            return redirect()->back()->with('success', 'Los registros seleccionados se han eliminado correctamente.');
        }
        return redirect()->back()->with('error', 'No hay registros seleccionados para eliminar.');
    }
}
