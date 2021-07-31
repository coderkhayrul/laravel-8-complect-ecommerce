<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function couponView(){

        $coupons = Coupon::orderBy('id', 'desc')->get();
        return view('backend.coupon.view_coupon', compact('coupons'));
    }

    public function couponStore(Request $request){

        $this->validate($request, [
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ],
        [
            'coupon_name.required' => 'Input Coupon Name',
            'coupon_discount.required' => 'Input Coupon Discount',
            'coupon_validity.required' => 'Input Coupon Validity',
        ]);

        $coupons = new Coupon();
        $coupons->coupon_name = strtoupper($request->coupon_name);
        $coupons->coupon_discount = $request->coupon_discount;
        $coupons->coupon_validity = $request->coupon_validity;
        $coupons->save();


        $notification =  array(
            'message' => 'Coupon Create Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-coupon')->with($notification);
    }

    public function couponEdit($id){

        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon', compact('coupon'));
    }

    public function couponUpdate(Request $request, $id){

        $coupon = Coupon::findOrFail($id);
        $coupon->coupon_name = strtoupper($request->coupon_name);
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->update();

        $notification =  array(
            'message' => 'Coupon Update Successfully',
            'alert-type' => 'info',
        );
        return redirect()->route('manage-coupon')->with($notification);

    }

    public function couponDelete($id){

        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        $notification =  array(
            'message' => 'Coupon Delete Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('manage-coupon')->with($notification);
    }
}
