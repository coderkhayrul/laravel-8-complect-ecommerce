<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use Illuminate\Http\Request;

class HomeBlogController extends Controller
{
    public function addBlogPost(){
        $blogPostCategory = BlogPostCategory::latest()->get();
        $blogPosts = BlogPost::latest()->get();

        return view('frontend.blog.blog_list', compact('blogPostCategory', 'blogPosts'));

    }

    public function blogPostDetails($id){

        $blogPost = BlogPost::findOrFail($id);
        $blogPostCategory = BlogPostCategory::latest()->get();

        return view('frontend.blog.blog_details', compact('blogPostCategory', 'blogPost'));

    }

    public function homeBlogCategoryPost($id){

        $blogPosts = BlogPost::where('category_id',$id)->orderBy('id', 'desc')->get();
        $blogPostCategory = BlogPostCategory::latest()->get();

        return view('frontend.blog.blog_cat_list', compact('blogPostCategory', 'blogPosts'));
    }
}
