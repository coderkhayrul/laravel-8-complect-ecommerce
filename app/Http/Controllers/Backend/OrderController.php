<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Pending Order Methord
    public function pendingOrders(){
        $orders = Order::where('status', 'Pending')->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function pendingOrdersDetails($order_id){

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_orders_details', compact('order', 'orderItem'));
    }

    public function pendingToConfirm($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Confirmed',
        ]);

        $notification =  array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('pending-orders')->with($notification);
    }

    // Confirmed Order Methord
     public function confirmedOrder(){

        $orders = Order::where('status', 'Confirmed')->orderBy('id', 'DESC')->get();

        return view('backend.orders.confirmed_orders', compact('orders'));
     }

    public function confirmedToProcessing($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Processing',
        ]);

        $notification =  array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('confirmed.order')->with($notification);
    }


    public function adminInvoiceDownload($order_id){
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('backend.orders.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

     // Processing Order Methord
     public function processingOrder(){

        $orders = Order::where('status', 'Processing')->orderBy('id', 'DESC')->get();

        return view('backend.orders.processing_orders', compact('orders'));
     }

     public function processingToPicked($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Picked',
        ]);

        $notification =  array(
            'message' => 'Order Picked Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('picked.order')->with($notification);
    }

     // Picker Order Methord
     public function pickedOrder(){

        $orders = Order::where('status', 'Picked')->orderBy('id', 'DESC')->get();

        return view('backend.orders.picked_orders', compact('orders'));
     }

     public function pickedToShipped($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Shipped',
        ]);

        $notification =  array(
            'message' => 'Order Shipped Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('picked.order')->with($notification);
    }

     // Shipped Order Methord
     public function shippedOrder(){

        $orders = Order::where('status', 'Shipped')->orderBy('id', 'DESC')->get();

        return view('backend.orders.shipped_orders', compact('orders'));
     }

     public function ShippedToDelivered($order_id){

        $product = OrderItem::where('order_id', $order_id)->get();

        foreach($product as $item){

            Product::where('id', $item->product_id)->update(['product_qty' => DB::raw('product_qty-'.$item->qty)]);

        }


        Order::findOrFail($order_id)->update([
            'status' => 'Delivered',
        ]);

        $notification =  array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('shipped.order')->with($notification);
    }

     // Delivered Order Methord
     public function deliveredOrder(){

        $orders = Order::where('status', 'Delivered')->orderBy('id', 'DESC')->get();

        return view('backend.orders.delivered_orders', compact('orders'));
     }

     public function DeliveredToCancel($order_id){
        Order::findOrFail($order_id)->update([
            'status' => 'Cancel',
        ]);

        $notification =  array(
            'message' => 'Order Cancel Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('delivered.order')->with($notification);
    }

     // Cancel Order Methord
     public function cancelOrder(){

        $orders = Order::where('status', 'Cancel')->orderBy('id', 'DESC')->get();

        return view('backend.orders.cancel_orders', compact('orders'));
     }


}
