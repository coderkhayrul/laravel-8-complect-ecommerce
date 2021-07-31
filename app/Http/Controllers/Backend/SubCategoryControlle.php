<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function GuzzleHttp\json_encode;

class SubCategoryControlle extends Controller
{
    public function subcategoryView(){
        $subcategories = SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('backend.subcategory.subcategory_view', compact('subcategories', 'categories'));
    }

    public function subcategoryStore(Request $request){
        $this->validate($request, [
            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',
            'category_id' => 'required',
        ],
        [
            'category_id.required' => 'Please Select Any Option',
            'subcategory_name_en.required' => 'Input Sub Category English Name',
            'subcategory_name_hin.required' => 'Input Sub Category Hindi Name',
        ]);

        $subcategory = new SubCategory();
        $subcategory->subcategory_name_en = $request->subcategory_name_en;
        $subcategory->subcategory_name_hin = $request->subcategory_name_hin;
        $subcategory->subcategory_slug_eng = Str::slug($request->subcategory_name_en);
        $subcategory->subcategory_slug_hin = preg_replace('/\s+/', '-', $request->subcategory_name_hin);
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        $notification =  array(
            'message' => 'Sub Category Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function subcategoryEdit($id){

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);

        return view('backend.subcategory.subcategory_edit', compact('subcategory','categories'));
    }

    public function subcategoryUpdate(Request $request, $id){

        $subcategory = SubCategory::findOrFail($id);

        $subcategory->subcategory_name_en = $request->subcategory_name_en;
        $subcategory->subcategory_name_hin = $request->subcategory_name_hin;
        $subcategory->subcategory_slug_eng = Str::slug($request->subcategory_name_en);
        $subcategory->subcategory_slug_hin = preg_replace('/\s+/', '-', $request->subcategory_name_hin);
        $subcategory->category_id = $request->category_id;
        $subcategory->update();

        $notification =  array(
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function subcategoryDelete($id){
        $subcategory =SubCategory::findOrFail($id);
        $subcategory->delete();

        $notification =  array(
            'message' => 'Sub Category Delete Successfully',
            'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }

    ////////////////////////THAT FOR SUB SUB-CATEGORY //////////////////////////

    public function subsubcategoryView(){
        $subsubcategories = SubSubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.sub_subcategory.sub_subcategory', compact('subsubcategories','categories'));
    }

    public function GetSubCategory($category_id) {
        $subcat = SubCategory::where('category_id', $category_id )->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    }
    public function GetSubSubCategory($subcategory_id) {
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id )->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcat);
    }

    public function subsubcategoryStore(Request $request) {

        $this->validate($request, [
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ],
        [
            'category_id.required' => 'Please Select Any Option',
            'subcategory_id.required' => 'Please Select Any Option',
            'subsubcategory_name_en.required' => 'Input Sub Category English Name',
            'subsubcategory_name_hin.required' => 'Input Sub Category Hindi Name',
        ]);

        $subsubcategory = new SubSubCategory();
        $subsubcategory->subsubcategory_name_en = $request->subsubcategory_name_en;
        $subsubcategory->subsubcategory_name_hin = $request->subsubcategory_name_hin;
        $subsubcategory->subsubcategory_slug_en = Str::slug($request->subsubcategory_name_en);
        $subsubcategory->subsubcategory_slug_hin = str_replace(' ', '-',$request->subsubcategory_name_hin);
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->save();

        $notification =  array(
            'message' => 'Sub Sub Category Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function subsubcategoryEdit($id){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::findOrFail($id);
        return view('backend.sub_subcategory.sub_subcategoryedit', compact('categories', 'subcategories', 'subsubcategories'));

    }

    public function sububcategoryUpdate(Request $request){

        $subsubcategory = SubSubCategory::findOrFail($request->id);
        $subsubcategory->subsubcategory_name_en = $request->subsubcategory_name_en;
        $subsubcategory->subsubcategory_name_hin = $request->subsubcategory_name_hin;
        $subsubcategory->subsubcategory_slug_en = Str::slug($request->subsubcategory_name_en);
        $subsubcategory->subsubcategory_slug_hin = str_replace(' ', '-',$request->subsubcategory_name_hin);
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->update();

        $notification =  array(
            'message' => 'Sub Sub Category Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    public function subsubcategoryDelete($id) {
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subsubcategory->delete();

        $notification =  array(
            'message' => 'Sub Sub Category Deleted Successfully',
            'alert-type' => 'info',
        );
        return back()->with($notification);
    }
}
