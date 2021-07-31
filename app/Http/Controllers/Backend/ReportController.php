<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportView(){
        return view('backend.report.report_view');
    }

    // Search Order Product By DateTime
    public function reportByDate(Request $request){

        $date = new DateTime($request->date);
        $formateDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formateDate)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    }

    // Search Order Product By Month
    public function reportByMonth(Request $request){

        $orders = Order::where('order_month', $request->month)->where('order_year', $request->year)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    }

    // Search Order Product By Year
    public function reportByYear(Request $request){

        $orders = Order::where('order_year', $request->only_year)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    }
}
