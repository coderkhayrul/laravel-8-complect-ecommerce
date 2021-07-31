@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row d-flex justify-content-center">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('coupon.update',$coupon->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Coupon Name</label>
                                    <input type="text" value="{{$coupon->coupon_name}}" name="coupon_name"
                                        class="form-control">
                                    @error('coupon_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Coupon Discount(%)</label>
                                    <input type="text" value="{{$coupon->coupon_discount}}" name="coupon_discount"
                                        class="form-control">
                                    @error('coupon_discount')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Coupon Validity Date</label>
                                    <input type="date" name="coupon_validity" value="{{$coupon->coupon_validity}}" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('coupon_validity')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>


            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection
