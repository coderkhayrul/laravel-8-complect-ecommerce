<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminUserController extends Controller
{
    public function allAdminRole()
    {
        $adminuser = Admin::where('type', 2)->latest()->get();

        return view('backend.role.admin_role_all', compact('adminuser'));
    }
    public function addAdminRole()
    {

        return view('backend.role.admin_role_create');
    }


    public function storeAdminRole(Request $request)
    {



        $image = $request->file('profile_photo_path');
        $name_generated = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_generated);
        $save_url = 'upload/admin_images/' . $name_generated;

        $adminUser = new Admin();
        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->password = Hash::make($request->password);
        $adminUser->phone = $request->phone;
        $adminUser->brand = $request->brand;
        $adminUser->category = $request->category;
        $adminUser->product = $request->product;
        $adminUser->slider = $request->slider;
        $adminUser->coupon = $request->coupon;
        $adminUser->shipping = $request->shipping;
        $adminUser->blog = $request->blog;
        $adminUser->returnorder = $request->returnorder;
        $adminUser->review = $request->review;
        $adminUser->orders = $request->orders;
        $adminUser->stock = $request->stock;
        $adminUser->reports = $request->reports;
        $adminUser->alluser = $request->alluser;
        $adminUser->adminuserrole = $request->adminuserrole;
        $adminUser->type = 2;

        $adminUser->profile_photo_path = $save_url;
        $adminUser->save();

        $notification =  array(
            'message' => 'Admin User Create Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.admin.user')->with($notification);
    }

    public function editAdminRole($id)
    {
        $adminuser = Admin::findOrFail($id);

        return view('backend.role.admin_role_edit', compact('adminuser'));
    }

    public function updateAdminRole(Request $request)
    {

        $admin_id =  $request->id;
        $old_image = $request->old_image;

        if ($request->file('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            if ($old_image) {
                unlink($old_image);
            }
            $name_generated = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_generated);
            $save_url = 'upload/admin_images/' . $name_generated;

            $adminUser = Admin::findOrFail($admin_id);
            $adminUser->name = $request->name;
            $adminUser->email = $request->email;
            $adminUser->phone = $request->phone;
            $adminUser->brand = $request->brand;
            $adminUser->category = $request->category;
            $adminUser->product = $request->product;
            $adminUser->slider = $request->slider;
            $adminUser->coupon = $request->coupon;
            $adminUser->shipping = $request->shipping;
            $adminUser->blog = $request->blog;
            $adminUser->returnorder = $request->returnorder;
            $adminUser->review = $request->review;
            $adminUser->orders = $request->orders;
            $adminUser->stock = $request->stock;
            $adminUser->reports = $request->reports;
            $adminUser->alluser = $request->alluser;
            $adminUser->adminuserrole = $request->adminuserrole;
            $adminUser->type = 2;

            $adminUser->profile_photo_path = $save_url;
            $adminUser->update();

            $notification =  array(
                'message' => 'Admin User Update Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.admin.user')->with($notification);
        } else {

            $adminUser = Admin::findOrFail($admin_id);
            $adminUser->name = $request->name;
            $adminUser->email = $request->email;
            $adminUser->phone = $request->phone;
            $adminUser->brand = $request->brand;
            $adminUser->category = $request->category;
            $adminUser->product = $request->product;
            $adminUser->slider = $request->slider;
            $adminUser->coupon = $request->coupon;
            $adminUser->shipping = $request->shipping;
            $adminUser->blog = $request->blog;
            $adminUser->returnorder = $request->returnorder;
            $adminUser->review = $request->review;
            $adminUser->orders = $request->orders;
            $adminUser->stock = $request->stock;
            $adminUser->reports = $request->reports;
            $adminUser->alluser = $request->alluser;
            $adminUser->adminuserrole = $request->adminuserrole;
            $adminUser->type = 2;

            $adminUser->update();

            $notification =  array(
                'message' => 'Admin Update Without Image Successfully',
                'alert-type' => 'info',
            );

            return redirect()->route('all.admin.user')->with($notification);
        }
    }

    public function deleteAdminRole($id)
    {
        $adminUser = Admin::findOrFail($id);

        if ($adminUser->profile_photo_path) {
            unlink($adminUser->profile_photo_path);
        }
        $adminUser->delete();

        $notification =  array(
            'message' => 'Admin Delete Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.admin.user')->with($notification);
    }
}
