<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function brandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function brandStore(Request $request){

        $this->validate($request, [
            'brand_name_en' => 'required',
            'brand_name_hin' => 'required',
            'brand_image' => 'required',
        ],
        [
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_hin.required' => 'Input Brand Hindi Name',
        ]);

        $image = $request->file('brand_image');
        $name_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/'.$name_generated);
        $save_url = 'upload/brand/'.$name_generated;

        $brand = new Brand();
        $brand->brand_name_en = $request->brand_name_en;
        $brand->brand_name_hin = $request->brand_name_hin;
        $brand->brand_slug_en = Str::slug($request->brand_name_en);
        $brand->brand_slug_hin = preg_replace('/\s+/', '-', $request->brand_name_hin);
        $brand->brand_image = $save_url;
        $brand->save();

        $notification =  array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function brandEdit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function brandUpdate(Request $request) {

        $brand_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            if ($old_image) {
                unlink($old_image);
            }
            $name_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/'.$name_generated);
            $save_url = 'upload/brand/'.$name_generated;

            $brand = Brand::findOrFail($brand_id);
            $brand->brand_name_en = $request->brand_name_en;
            $brand->brand_name_hin = $request->brand_name_hin;
            $brand->brand_slug_en = Str::slug($request->brand_name_en);
            $brand->brand_slug_hin = Str::slug($request->brand_name_hin);
            $brand->brand_image = $save_url;
            $brand->save();

            $notification =  array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info',
            );
            return redirect()->route('all.brand')->with($notification);
        }else{

            $brand = Brand::findOrFail($brand_id);
            $brand->brand_name_en = $request->brand_name_en;
            $brand->brand_name_hin = $request->brand_name_hin;
            $brand->brand_slug_en = Str::slug($request->brand_name_en);
            $brand->brand_slug_hin = Str::slug($request->brand_name_hin);
            $brand->save();

            $notification =  array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info',
            );
            return redirect()->route('all.brand')->with($notification);
        }

    }

    public function brandDelete($id) {
        $brand =Brand::findOrFail($id);
        $img = $brand->brand_image;
        if ($img) {
            unlink($img);
        }
        $brand->delete();

        $notification =  array(
            'message' => 'Brand Delete Successfully',
            'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }
}
