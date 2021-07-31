<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin_profile', compact('adminData'));
    }

    public function adminProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = Admin::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            if ($data->profile_photo_path) {
                @unlink(public_path('upload/admin_images/' . $data->profile_photo_path));
            }

            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    public function adminProfilePassword()
    {
        $id = Auth::user()->id;
        $editPassword = Admin::find($id);

        return view('admin.admin_profile_password', compact('editPassword'));
    }

    public function updateProfilePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $id = Auth::user()->id;
        $HasPassword = Admin::find($id)->password;

        if (Hash::check($request->current_password, $HasPassword)) {
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
    }

    public function Allusers()
    {
        $users = User::latest()->get();

        return view('backend.user.all_user', compact('users'));
    }
}
