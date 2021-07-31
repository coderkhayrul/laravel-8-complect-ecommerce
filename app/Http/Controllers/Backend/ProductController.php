<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    public function allProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function storeProduct(Request $request) {

        $image = $request->file('product_thambnail');
        $name_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thambnail/'.$name_generated);
        $save_url = 'upload/products/thambnail/'.$name_generated;


        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => Str::slug($request->product_name_en),
            'product_slug_hin' => preg_replace('/\s+/', '-', $request->product_name_hin),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tag_en' => $request->product_tag_en,
            'product_tag_hin' => $request->product_tag_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description_en' => $request->short_description_en,
            'short_description_hin' => $request->short_description_hin,
            'long_description_en' => $request->long_description_en,
            'long_description_hin' => $request->long_description_hin,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thambnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // <!-- Multiple Inage Upload -->
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $image = $request->file('product_thambnail');
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/'.$make_name);
            $upload_path = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification =  array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-product')->with($notification);

    }

    public function manageProduct(){
        $products = Product::latest()->get();

        return view('backend.product.product_view', compact('products'));
    }

    public function editProduct($id){

        $multiimages = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();


        $product = Product::findOrFail($id);

        return view('backend.product.product_edit', compact('product', 'categories', 'brands', 'subcategories', 'subsubcategories', 'multiimages'));

    }

    public function updateProduct(Request $request) {

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => Str::slug($request->product_name_en),
            'product_slug_hin' => preg_replace('/\s+/', '-', $request->product_name_hin),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tag_en' => $request->product_tag_en,
            'product_tag_hin' => $request->product_tag_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description_en' => $request->short_description_en,
            'short_description_hin' => $request->short_description_hin,
            'long_description_en' => $request->long_description_en,
            'long_description_hin' => $request->long_description_hin,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification =  array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-product')->with($notification);
    }

    public function multiImageUpdate(Request $request){

        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {
            // dd($img);
            $imageDel = MultiImg::findOrFail($id);
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            if ($imageDel) {
                unlink($imageDel->photo_name);
            }
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification =  array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    }

    public function productImageUpdate(Request $request){

        $product_id = $request->id;
        $old_image = $request->old_image;


        $image = $request->file('product_thambnail');
        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        if ($old_image) {
            unlink($old_image);
        }
        Image::make($image)->resize(917, 1000)->save('upload/products/thambnail/'.$make_name);
        $upload_path = 'upload/products/thambnail/'.$make_name;

        Product::findOrFail($product_id)->update([
            'product_thambnail' => $upload_path,
            'updated_at' => Carbon::now(),
        ]);

        $notification =  array(
            'message' => 'Product Image Thambnail Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    }

    // Multiple Image Delete
    public function multiImageDelete($id){
        $old_image = MultiImg::findOrFail($id);
        unlink($old_image->photo_name);
        $old_image->delete();

        $notification =  array(
            'message' => 'Product Image Delete Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    // PRODCUT STATUS METHOD
    public function productActive($id) {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->update();

        $notification =  array(
            'message' => 'Product Active Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function productInActive($id) {

        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->update();

        $notification =  array(
            'message' => 'Product Inactive Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function productDelete($id){

        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        $product->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $image){
           unlink($image->photo_name);
           MultiImg::where('product_id', $id)->delete();

        }

        $notification =  array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    // Product Stock
    public function productStock(){
        $products = Product::latest()->get();

        return view('backend.product.product_stock', compact('products'));
    }
}
