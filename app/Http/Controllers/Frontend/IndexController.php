<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name_en', 'asc')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'desc')->limit(3)->get();
        $products = Product::where('status', 1)->orderBy('id', 'desc')->limit(6)->get();
        $features = Product::where('featured', 1)->orderBy('id', 'desc')->limit(6)->get();
        $special_offer = Product::where('special_offer', 1)->orderBy('id', 'desc')->limit(4)->get();
        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'desc')->limit(4)->get();
        $blogPosts = BlogPost::latest()->get();

        // Show Product Category Link
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)
            ->where('category_id', $skip_category_1->id)
            ->orderBy('id', 'desc')->limit('5')->get();

        $skip_brand_1 = Brand::skip(4)->first();
        $skip_brand_product_1 = Product::where('status', 1)
            ->where('brand_id', $skip_brand_1->id)
            ->orderBy('id', 'desc')->limit('5')->get();


        return view('frontend.index', compact(
            'categories',
            'sliders',
            'products',
            'features',
            'special_offer',
            'special_deals',
            'skip_product_1',
            'skip_category_1',
            'skip_brand_1',
            'skip_brand_product_1',
            'blogPosts'
        ));
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            if ($data->profile_photo_path) {
                @unlink(public_path('upload/user_images/' . $data->profile_photo_path));
            }
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function userChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function userPasswordUpdate(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $HasPassword = Auth::user()->password;

        if (Hash::check($request->current_password, $HasPassword)) {

            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }

    public function productDetails($id, $slug)
    {

        $product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',', $color_en);

        $color_hin = $product->product_color_hin;
        $product_color_hin = explode(',', $color_hin);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',', $size_en);

        $size_hin = $product->product_size_hin;
        $product_size_hin = explode(',', $size_hin);

        $multiimage = MultiImg::where('product_id', $id)->get();
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'desc')->get();


        return view('frontend.product.product_details', compact(
            'product',
            'multiimage',
            'product_color_en',
            'product_color_hin',
            'product_size_en',
            'product_size_hin',
            'relatedProduct',
        ));
    }

    public function tagWiseProduct($tag)
    {

        $products = Product::where('status', 1)->where('product_tag_en', $tag)->orderBy('id', 'desc')->paginate(2);
        $categories = Category::with(['category'])->orderBy('category_name_en', 'asc')->get();
        return view('frontend.tag.tags_view', compact('products', 'categories'));
    }

    public function subcatWiseProduct($id, $slug)
    {

        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'desc')->paginate(2);
        $categories = Category::orderBy('category_name_en', 'asc')->get();
        $breadcrumsub = SubCategory::where('id', $id)->get();

        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadcrumsub'));
    }

    public function subSubcatWiseProduct($id, $slug)
    {
        // dd($slug);
        $products = Product::where('status', 1)->where('subsubcategory_id', $id)->orderBy('id', 'desc')->paginate(2);
        $categories = Category::orderBy('category_name_en', 'asc')->get();
        $breadcrums = SubSubCategory::where('id', $id)->get();

        return view('frontend.product.subsubcategory_view', compact('products', 'categories', 'breadcrums'));
    }

    // Product View With Ajex
    public function productViewAjex($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',', $color);

        $size = $product->product_size_en;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    // Product Search Method
    public function productSearch(Request $request)
    {
        $request->validate(['search' => 'required']);

        $item = $request->search;
        $categories = Category::orderBy('category_name_en', 'asc')->get();
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->get();
        return view('frontend.product.search', compact('products', 'categories'));
    }

    // Advance Search Method
    public function searchProduct(Request $request)
    {
        $request->validate(['search' => 'required']);

        $item = $request->search;
        $products = Product::where('product_name_en', 'LIKE', "%$item%")->select('product_name_en', 'product_thambnail', 'selling_price', 'id', 'product_slug_en')->limit(5)->get();

        return view('frontend.product.search_product', compact('products'));
    }
}
