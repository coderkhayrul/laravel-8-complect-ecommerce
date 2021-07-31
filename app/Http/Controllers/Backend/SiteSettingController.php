<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class SiteSettingController extends Controller
{
    public function siteSetting(){
        $setting = SiteSetting::find(1);

        return view('backend.setting.setting_update', compact('setting'));
    }

    public function updateSiteSetting(Request $request){

        $id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('logo')) {
            $image = $request->file('logo');
            if ($old_image) {
                unlink($old_image);
            }

        $image = $request->file('logo');
        $name_generated = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(139, 36)->save('upload/logo/'.$name_generated);
        $save_url = 'upload/logo/'.$name_generated;

        $setting = SiteSetting::findOrFail($id);
        $setting->phone_one = $request->phone_one;
        $setting->phone_two = $request->phone_two;
        $setting->email = $request->email;
        $setting->company_name = $request->company_name;
        $setting->company_address = $request->company_address;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->linkedin = $request->linkedin;
        $setting->youtube = $request->youtube;
        $setting->logo = $save_url;
        $setting->save();

        $notification =  array(
            'message' => 'Setting Updated With Image Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }else{

        $setting = SiteSetting::findOrFail($id);
        $setting->phone_one = $request->phone_one;
        $setting->phone_two = $request->phone_two;
        $setting->email = $request->email;
        $setting->company_name = $request->company_name;
        $setting->company_address = $request->company_address;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->linkedin = $request->linkedin;
        $setting->youtube = $request->youtube;
        $setting->save();

        $notification =  array(
            'message' => 'Setting Updated With Out Image Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }

    }

    public function seoSetting(){

        $seo = Seo::find(1);

        return view('backend.setting.seo_setting', compact('seo'));
    }

    public function updateSeoSetting(Request $request){
        $id = $request->id;

        $seo = Seo::find($id);
        $seo->meta_title = $request->meta_title;
        $seo->meta_author = $request->meta_author;
        $seo->meta_keyword = $request->meta_keyword;
        $seo->meta_description = $request->meta_description;
        $seo->google_analytics = $request->google_analytics;
        $seo->save();

        $notification =  array(
            'message' => 'Seo Setting Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);

    }
}
