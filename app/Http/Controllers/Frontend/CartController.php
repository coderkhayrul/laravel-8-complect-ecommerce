<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id){

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]]);
                return response()->json([
                    'succeed' => 'Successfully Adder On your cart'
                ]);

        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]]);

            return response()->json([
                'success' => 'Successfully Adder On Your cart'
            ]);

            }
    }

    // Mini Cart Section
    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }


    public function removeMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json([
            'success' => 'Product Remove from Cart'
        ]);
    }

    // Add To addToWishlist
    public function addToWishlist(Request $request, $product_id){
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {

                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json([
                    'success' => 'Wishlist Added'
                ]);
            }else{

                return response()->json([
                    'error' => 'This Product already Added To Wishlist'
                ]);
            }

        }else{
            return response()->json([
                'error' => 'At First login Your Account'
            ]);
        }
    }

    // Coupon Apply
    public function couponApply(Request $request){

        // return $request->all();
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
        ->first();

        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100)

            ]);

            return response()->json(array(
                'validity' => true,
                'success', 'Coupon Applied Successfully'));
        }else{
            return response()->json(['error' => 'Coupon Invalid']);
        }
    }

    public function couponCalculation(){
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => Session::get('coupon')['coupon_name'],
                'coupon_discount' => Session::get('coupon')['coupon_discount'],
                'discount_amount' => Session::get('coupon')['discount_amount'],
                'total_amount' => Session::get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    // Remove Coupon
    public function couponRemove(){
        Session::forget('coupon');
            return response()->json(['success' => 'Coupon Remove Successfully']);

    }


    //////////////////////// CHECKOUT METHORD  //////////////////////

    public function checkoutCreate(){

        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));
            }else{
                $notification =  array(
                    'message' => 'Shopping at list  One Product',
                    'alert-type' => 'error',
                );

                return redirect()->to('/')->with($notification);
            }
        }else{

            $notification =  array(
                'message' => 'You Need To Login First',
                'alert-type' => 'error',
            );

            return redirect()->route('login')->with($notification);
        }
    }

}
