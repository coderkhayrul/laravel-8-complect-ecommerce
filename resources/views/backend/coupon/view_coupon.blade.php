@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Coupon <span class="badge badge-pill badge-danger badge-sm">{{ count($coupons) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Coupon Name</th>
                                        <th>Coupon Discount</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->coupon_name }}
                                        </td>
                                        <td>{{ $item->coupon_discount }}%</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($item->coupon_validity)->format('D,d F Y') }}
                                        </td>
                                        <td>
                                            @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge badge-pill badge-success">Valid</span>
                                            @else
                                            <span class="badge badge badge-pill badge-danger">Invalid</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('coupon.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>

                                            <a title="Delete Data" href="{{ route('coupon.delete',$item->id) }}"
                                            id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            {{-- //////////////////////----- ADD COUPON -----///////////////////////// --}}
            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('coupon.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Coupon Name</label>
                                    <input type="text" id="coupon_name" name="coupon_name"
                                        class="form-control">
                                    @error('coupon_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Discount(%)</label>
                                    <input type="text" id="coupon_discount" name="coupon_discount"
                                        class="form-control">
                                    @error('coupon_discount')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Coupon Validity Date</label>
                                    <input type="date" name="coupon_validity" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('coupon_validity')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Insert Coupon</button>
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
