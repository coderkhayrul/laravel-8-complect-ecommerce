<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class BlogController extends Controller
{
    public function BlogCategory(){

        $blogCategory = BlogPostCategory::latest()->get();

        return view('backend.blog.category.category_view', compact('blogCategory'));
    }

    public function BlogCategoryStore(Request $request){

        $this->validate($request, [
            'blog_category_name_en' => 'required',
            'blog_category_name_hin' => 'required',
        ],
        [
            'blog_category_name_en.required' => 'Input Blog category English Name',
            'blog_category_name_hin.required' => 'Input Blog category Hindi Name',
        ]);

        $blogCategory = new BlogPostCategory();
        $blogCategory->blog_category_name_en = $request->blog_category_name_en;
        $blogCategory->blog_category_name_hin = $request->blog_category_name_hin;
        $blogCategory->blog_category_slug_en = Str::slug($request->blog_category_name_en);
        $blogCategory->blog_category_slug_hin = preg_replace('/\s+/', '-', $request->blog_category_name_hin);
        $blogCategory->save();

        $notification =  array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function BlogCategoryEdit($id){
        $blogCategory = BlogPostCategory::findOrFail($id);

        return view('backend.blog.category.category_edit', compact('blogCategory'));
    }

    public function BlogCategoryUpdate(Request $request){

        $this->validate($request, [
            'blog_category_name_en' => 'required',
            'blog_category_name_hin' => 'required',
        ],
        [
            'blog_category_name_en.required' => 'Input Blog category English Name',
            'blog_category_name_hin.required' => 'Input Blog category Hindi Name',
        ]);

        $blogCategory = BlogPostCategory::findOrFail($request->id);
        $blogCategory->blog_category_name_en = $request->blog_category_name_en;
        $blogCategory->blog_category_name_hin = $request->blog_category_name_hin;
        $blogCategory->blog_category_slug_en = Str::slug($request->blog_category_name_en);
        $blogCategory->blog_category_slug_hin = preg_replace('/\s+/', '-', $request->blog_category_name_hin);
        $blogCategory->update();

        if ($blogCategory->update() == true) {

            $notification =  array(
                'message' => 'Blog Category Update Successfully',
                'alert-type' => 'info',
            );
        }

        return redirect()->route('blog.category')->with($notification);
    }

    public function BlogCategoryDelete($id){

        $blogCategory = BlogPostCategory::findOrFail($id)->delete();

        $notification =  array(
            'message' => 'Blog Category Delete Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }


    // VIEW VLOG POST
    public function viewBlogPost(Request $request){
        $blogPosts = BlogPost::latest()->get();

        return view('backend.blog.post.post_view', compact('blogPosts'));
    }

    public function blogPostAdd(){
        $blogCategory = BlogPostCategory::latest()->get();
        $blogPosts = BlogPostCategory::latest()->get();

        return view('backend.blog.post.post_add', compact('blogPosts', 'blogCategory'));
    }

    public function blogPostStore(Request $request){

        $this->validate($request, [
            'category_id' => 'required',
            'post_title_en' => 'required',
            'post_title_hin' => 'required',
            'post_image' => 'required',
            'post_details_en' => 'required',
            'post_details_hin' => 'required',
        ]);

        $image = $request->file('post_image');
        $name_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(780, 433)->save('upload/blog/'.$name_generated);
        $save_url = 'upload/blog/'.$name_generated;

        $blogPost = new BlogPost();
        $blogPost->category_id = $request->category_id;
        $blogPost->post_title_en = $request->post_title_en;
        $blogPost->post_title_hin = $request->post_title_hin;
        $blogPost->	post_slug_en = Str::slug($request->post_title_en);
        $blogPost->	post_slug_hin = preg_replace('/\s+/', '-', $request->post_title_hin);
        $blogPost->post_details_en = $request->post_details_en;
        $blogPost->post_details_hin = $request->post_details_hin;
        $blogPost->post_image = $save_url;
        $blogPost->save();

        if ($blogPost->save() == true) {

            $notification =  array(
                'message' => 'Blog Inserted Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }

        return back();

    }

    public function blogPostEdit($id){
        $blogPostCategory =BlogPostCategory::latest()->get();
        $blogPost = BlogPost::findOrFail($id);

        return view('backend.blog.post.post_edit', compact('blogPost', 'blogPostCategory'));
    }


    public function blogPostUpdate(Request $request, $id){
        $postId = $request->id;

        $blogPost = BlogPost::findOrFail($postId);
        $blogPost->category_id = $request->category_id;
        $blogPost->post_title_en = $request->post_title_en;
        $blogPost->post_title_hin = $request->post_title_hin;
        $blogPost->	post_slug_en = Str::slug($request->post_title_en);
        $blogPost->	post_slug_hin = preg_replace('/\s+/', '-', $request->post_title_hin);
        $blogPost->post_details_en = $request->post_details_en;
        $blogPost->post_details_hin = $request->post_details_hin;
        $blogPost->update();

        if ($blogPost->update() ==true) {
            $notification =  array(
                'message' => 'Blog Update Successfully',
                'alert-type' => 'info',
            );
        }

        return redirect()->route('view.blog.post')->with($notification);

    }


    public function blogPostDelete($id){

        $blogPost = BlogPost::findOrFail($id);
        unlink($blogPost->post_image);
        $blogPost->delete();

        $notification =  array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function blogPostImageUpdate(Request $request){

        $post_id = $request->id;
        $old_image = $request->old_image;


        $image = $request->file('post_image');
        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        if ($old_image) {
            unlink($old_image);
        }
        Image::make($image)->resize(780, 433)->save('upload/blog/'.$make_name);
        $upload_path = 'upload/blog/'.$make_name;

        BlogPost::findOrFail($post_id)->update([
            'post_image' => $upload_path,
            'updated_at' => Carbon::now(),
        ]);

        $notification =  array(
            'message' => 'Post Image Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    }
}
