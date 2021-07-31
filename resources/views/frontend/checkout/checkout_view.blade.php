@extends('frontend.main_master')
{{-- @if (session()->get('language') == 'hindi') घर @else Home @endif --}}
@section('title')
Checkout | Easy Online Shop
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <!-- panel-heading -->

                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- guest-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <p class="text title-tag-line"><b>Shipping Address:</b></p>
                                            <form class="register-form" action="{{ route('checkout.store') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Shipping Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="shipping_name" name="shipping_name" placeholder="Full Name"
                                                        value="{{ Auth::user()->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email<span class="text-danger">*</span></label>
                                                    <input type="email"
                                                        class="form-control unicase-form-control text-input"
                                                        id="shipping_email" name="shipping_email" placeholder="Email"
                                                        value="{{ Auth::user()->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Phone<span class="text-danger">*</span></label>
                                                    <input type="number"
                                                        class="form-control unicase-form-control text-input"
                                                        id="shipping_phone" name="shipping_phone" placeholder="Phone"
                                                        value="{{ Auth::user()->phone }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Post Code<span class="text-danger">*</span></label>
                                                    <input type="number"
                                                        class="form-control unicase-form-control text-input"
                                                        id="post_code" name="post_code" placeholder="Post Code"
                                                        required>
                                                </div>
                                        </div>
                                        <!-- guest-login -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">

                                            <div class="form-group">
                                                <label for="">Division Select<span class="text-danger">*</span></label>
                                                <select name="division_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Division</option>
                                                    @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->division_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('division_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">District Select<span class="text-danger">*</span></label>
                                                <select name="district_id" id="district_id" class="form-control"
                                                    required>
                                                    <option value="" selected disabled>Select Your District</option>

                                                </select>
                                                @error('district_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">State Select<span class="text-danger">*</span></label>
                                                <select name="state_id" id="state_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your State</option>

                                                </select>
                                                @error('state_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Notes<span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="notes" placeholder="notes"
                                                    id="notes" cols="30" rows="5"></textarea>
                                                @error('notes')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">

                                        @foreach ($carts as $item)
                                        <li>
                                            <strong>Image: </strong>
                                            <img src="{{ asset($item->options->image) }}" alt=""
                                                style="height: 50px; width: 50px;">
                                        </li>
                                        <li>
                                            <strong>Qty: </strong>
                                            ( {{ $item->qty }} )

                                            <strong>Color: </strong>
                                            {{ $item->options->color }}

                                            <strong>Size: </strong>
                                            {{ $item->options->size }}
                                        </li>
                                        <br>
                                        @endforeach
                                        <li>
                                            <hr>
                                            @if (Session::has('coupon'))

                                            <strong>SubTotal: </strong>${{ $cartTotal }}
                                            <hr>
                                            <strong>Coupon Name: </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            ({{ session::get('coupon')['coupon_discount'] }}%)
                                            <hr>

                                            <strong>Coupon Discount</strong>: </strong>
                                            ${{ session()->get('coupon')['discount_amount'] }}
                                            <hr>

                                            <strong>Grand Total</strong>: </strong>
                                            ${{ session()->get('coupon')['total_amount'] }}
                                            <hr>

                                            @else

                                            <strong>SubTotal: </strong>${{ $cartTotal }}
                                            <hr>
                                            <strong>Grand Total: </strong>${{ $cartTotal }}
                                            <hr>

                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>

                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Striped</label>
                                        <input type="radio" name="paynemt_method" value="stripe">
                                        <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Card</label>
                                        <input type="radio" name="paynemt_method" value="card">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}" alt="">

                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Cash</label>
                                        <input type="radio" name="paynemt_method" value="cash">
                                        <img src="{{ asset('frontend/assets/images/payments/6.png') }}" alt="">

                                    </div>
                                </div><!-- End Row -->
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment
                                    Step</button>

                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->
                </div>
                </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brands')

        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->


{{-- Get All District By Division --}}
<script type="text/javascript">
    $(document).ready(function () {

        // Get Dristrict Data
        $('select[name="division_id"]').on('change', function () {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{  url('/checkout/district/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="district_id"]').empty();
                        var d = $('select[name="state_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .district_name + '</option>');
                        });
                    }

                });
            } else {
                alert('danger');
            }
        });

        // Get State Data
        $('select[name="district_id"]').on('change', function () {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{  url('/checkout/state/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="state_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="state_id"]').append('<option value="' +
                                value.id + '">' + value.state_name + '</option>'
                                );
                        });
                    }

                });
            } else {
                alert('danger');
            }
        });
    });

</script>

@endsection
