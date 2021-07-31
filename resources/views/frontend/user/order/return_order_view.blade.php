@extends('frontend.main_master')
@section('title')
Return Order | Easy Online Shop
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
                                <td class="col-md-1">
                                    <label for="">Order Resone</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">Order Status</label>
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
                                    <label for="">{{ $order->return_reason }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for="">
                                        @if ($order->return_order == 0)
                                        <span style="background: #418DB9" class="badge badge-pill badge-warning">
                                            No Return Requested
                                        </span>
                                        @elseif ($order->return_order == 1)
                                        <span style="background: #A52A2A" class="badge badge-pill badge-warning">
                                            Pending
                                        </span>
                                        <span style="background: #FF0000" class="badge badge-pill badge-warning">
                                            Return Requested
                                        </span>
                                        @elseif ($order->return_order == 2)
                                        <span style="background: #008000" class="badge badge-pill badge-warning">
                                            Successful Return
                                        </span>
                                        @endif
                                    </label>
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
