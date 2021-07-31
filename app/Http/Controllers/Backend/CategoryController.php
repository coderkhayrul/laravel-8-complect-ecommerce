<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function categoryView() {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));

    }

    public function categoryStore(Request $request) {
        $this->validate($request, [
            'category_name_en' => 'required',
            'category_name_hin' => 'required',
            'category_icon' => 'required',
        ],
        [
            'category_name_en.required' => 'Input category English Name',
            'category_name_hin.required' => 'Input category Hindi Name',
        ]);

        $category = new Category();
        $category->category_name_en = $request->category_name_en;
        $category->category_name_hin = $request->category_name_hin;
        $category->category_slug_en = Str::slug($request->category_name_en);
        $category->category_slug_hin = preg_replace('/\s+/', '-', $request->category_name_hin);
        $category->category_icon = $request->category_icon;
        $category->save();

        $notification =  array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function categoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id){

        $category_id = $request->id;

        $category = Category::findOrFail($category_id);
        $category->category_name_en = $request->category_name_en;
        $category->category_name_hin = $request->category_name_hin;
        $category->category_slug_en = Str::slug($request->category_name_en);
        $category->category_slug_hin = preg_replace('/\s+/', '-', $request->category_name_hin);
        $category->category_icon = $request->category_icon;
        $category->save();

        $notification =  array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'info',
        );
        return redirect()->route('all.category')->with($notification);
        }

        public function categoryDelete($id) {

            $category =Category::findOrFail($id);
            $category->delete();

            $notification =  array(
                'message' => 'Category Delete Successfully',
                'alert-type' => 'info',
            );
            return redirect()->back()->with($notification);
        }
}
