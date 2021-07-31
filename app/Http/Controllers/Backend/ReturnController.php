<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function returnRequest(){
        $orders = Order::where('return_order', 1)->orderBy('id', 'desc')->get();

        return view('backend.return_order.return_request', compact('orders'));
    }

    public function returnApprove($id){

        $order = Order::findOrFail($id);
        $order->return_order = 2;
        $order->update();

        $notification =  array(
            'message' => 'Return Order Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function returnAllRequest(){
        $allreturn = Order::where('return_order', 2)->get();

        return view('backend.return_order.return_request_all', compact('allreturn'));
    }
}
