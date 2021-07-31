@extends('frontend.main_master')
@section('title')
    Order Tracking | Easy Online Shop
@endsection

@section('content')
    <style type="text/css">
        body {
            background-color: #eeeeee;
            font-family: 'Open Sans', serif
        }


        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #0f6cb2
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #0f6cb2;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }

    </style>
    <div class="container">
        <article class="card">
            <header class="card-header"> <b> My Orders / Tracking </b></header>
            <div class="card-body">
                <div class="row" style=" margin-left: 30px; margin-top:20px;">
                    <div class="col-md-2">
                        <b>Invoice Number</b><br>
                        {{ $tracked->invoice_no }}
                    </div> <!-- /.col end -->

                    <div class="col-md-2">
                        <b>Order Date</b><br>
                        {{ $tracked->order_date }}
                    </div> <!-- /.col end -->

                    <div class="col-md-2">
                        <b>Shipping By - {{ $tracked->user->name }}</b><br>
                        {{ $tracked->division->division_name }}/
                        {{ $tracked->district->district_name }}
                    </div> <!-- /.col end -->

                    <div class="col-md-2">
                        <b>User Mobile Number</b><br>
                        {{ $tracked->phone }}
                    </div> <!-- /.col end -->

                    <div class="col-md-2">
                        <b>Payment Method</b><br>
                        {{ $tracked->payment_method }}
                    </div> <!-- /.col end -->

                    <div class="col-md-2">
                        <b>Total Amount</b><br>
                        ${{ $tracked->amount }}
                    </div> <!-- /.col end -->
                </div> <!-- /.row end -->

                <div class="track">
                    <!-- Order Pending Start -->
                    @if ($tracked->status == 'Pending')
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Pending</span>
                        </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Confirmed</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Processing </span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Picked</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Shipped</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Delivered</span>
                        </div>
                        <!-- Order Pending End -->
                        <!-- Order Confirmed Start -->
                    @elseif($tracked->status == 'Confirmed')
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Pending</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Confirmed</span>
                        </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Processing </span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Picked</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Shipped</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Delivered</span>
                        </div>
                        <!-- Order Confirmed Start -->
                        <!-- Order Processing Start -->
                    @elseif($tracked->status == 'Processing')
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Pending</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Confirmed</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Processing</span>
                        </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Picked</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Shipped</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Delivered</span>
                        </div>
                        <!-- Order Processing End -->
                        <!-- Order Picked Start -->
                    @elseif($tracked->status == 'Picked')
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Pending</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Confirmed</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Processing</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Picked</span>
                        </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Order Shipped</span>
                        </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Delivered</span>
                        </div>
                        <!-- Order Picked End -->
                        <!-- Order Shipped Start -->
                    @elseif($tracked->status == 'Shipped')
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Pending</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Confirmed</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Processing</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Picked</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Shipped</span>
                        </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">
                                Delivered</span>
                        </div>
                        <!-- Order Shipped End -->
                        <!-- Order Delivered Start -->
                    @elseif($tracked->status == 'Delivered')
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Pending</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Confirmed</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Processing</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Picked</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Shipped</span>
                        </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Delivered</span>
                        </div>
                        <!-- Order Delivered End -->
                    @endif

                </div>
                <br><br>
            </div>
        </article>
    </div>
@endsection
