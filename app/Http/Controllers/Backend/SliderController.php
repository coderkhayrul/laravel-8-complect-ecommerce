<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function manageSlider(){

        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    }

    public function storeSlider(Request $request){
        $this->validate($request,[
            'slider_image' => 'required',
        ],
        [
            'slider_image.required' => 'Please Select One Image',
        ]);

        $image = $request->file('slider_image');
        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(870, 370)->save('upload/slider/'.$make_name);
        $upload_path = 'upload/slider/'.$make_name;

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->slider_image = $upload_path;
        $slider->status = 1;
        $slider->save();

        if ($slider->save() == true) {

            $notification =  array(
                'message' => 'Slider Inserted Successfully',
                'alert-type' => 'success',
            );
        }
        return redirect()->back()->with($notification);
    }

    public function editSlider($id){

        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit',compact('slider'));
    }

    public function updateSlider(Request $request){
        $slider_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            if ($old_image) {
                unlink($old_image);
            }
            $name_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(870, 370)->save('upload/slider/'.$name_generated);
            $save_url = 'upload/slider/'.$name_generated;

            $slider = Slider::findOrFail($slider_id);
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->slider_image = $save_url;
            $slider->save();

            $notification =  array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'info',
            );
            return redirect()->route('manage-slider')->with($notification);
        }else{

            $slider = Slider::findOrFail($slider_id);
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->save();

            $notification =  array(
                'message' => 'Slider Updated Successfully',
                'alert-type' => 'info',
            );
            return redirect()->route('manage-slider')->with($notification);
        }
    }

    public function deleteSlider($id){

        $slider =Slider::findOrFail($id);

        if ($slider->slider_image) {
            unlink($slider->slider_image);
        }
        $slider->delete();

        $notification =  array(
            'message' => 'Slider Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    // PRODCUT STATUS METHOD
    public function sliderActive($id) {
        $slider = Slider::findOrFail($id);
        $slider->status = 1;
        $slider->update();

        $notification =  array(
            'message' => 'Slider Active Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function sliderInActive($id) {

        $slider = Slider::findOrFail($id);
        $slider->status = 0;
        $slider->update();

        $notification =  array(
            'message' => 'Slider Inactive Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
