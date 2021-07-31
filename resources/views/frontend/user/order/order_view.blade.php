@extends('frontend.main_master')
@section('title')
Order | Easy Online Shop
@endsection

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr style="background:#e2e2e2">
                                <td class="col-md-1">
                                    <label for="">Date</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">Total</label>
                                </td>
                                <td class="col-md-3">
                                    <label for="">Payment</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Invoice</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Order</label>
                                </td>
                                <td class="col-md-1">
                                    <label for="">Action</label>
                                </td>
                            </tr>
                            @foreach ($orders as $order)
                            <tr>
                                <td class="col-md-1">
                                    <label for="">{{ $order->order_date }}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="">${{ $order->amount }}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for="">{{ $order->payment_method }}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for="">{{ $order->invoice_no }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">
                                        @if ($order->status == 'Pending')
                                        <span style="background: #800080" class="badge badge-pill badge-warning"> Pending </span>
                                        @elseif ($order->status == 'Confirmed')
                                        <span style="background: #0000FF" class="badge badge-pill badge-warning"> Confirmed </span>
                                        @elseif ($order->status == 'Processing')
                                        <span style="background: #FFA500" class="badge badge-pill badge-warning"> Processing </span>
                                        @elseif ($order->status == 'Picked')
                                        <span style="background: #808000" class="badge badge-pill badge-warning"> Picked </span>
                                        @elseif ($order->status == 'Shipped')
                                        <span style="background: #808080" class="badge badge-pill badge-warning"> Shipped </span>
                                        @elseif ($order->status == 'Delivered')
                                        <span style="background: #008000" class="badge badge-pill badge-warning"> Delivered </span>
                                            @if ($order->return_order == 1)
                                            <span style="background: #FF0000" class="badge badge-pill badge-warning">
                                                Return Requested
                                            </span>
                                            @endif
                                        @else
                                        <span style="background: #FF0000" class="badge badge-pill badge-warning"> Cancel</span>
                                        @endif
                                    </label>
                                </td>
                                <td class="col-md-1">
                                   <a href="{{ url('user/order_details',$order->id) }}" class="btn btn-sm btn-primary "><i class="fa fa-eye"></i> View</a>
                                   <br>
                                   <a target="_blank" href="{{ url('user/invoice_download',$order->id) }}" class="btn btn-sm btn-danger" style="margin-top:5px"><i class="fa fa-download"></i> Invoice</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
             </div> <!-- end col-md-8 -->

        </div> <!-- /.end row -->
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
