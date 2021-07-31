@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Product <span class="badge badge-pill badge-danger badge-sm">{{ count($products) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name English</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)

                                    <tr>
                                        <td class="text-center">
                                            <img style=" width:60px; height: 50px;" src="{{ asset($item->product_thambnail) }}" alt="">
                                        </td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>${{ $item->selling_price }}</td>
                                        <td>{{ $item->product_qty }}</td>
                                        <td>
                                            @if ($item->discount_price == null)
                                            <span class="badge badge badge-pill badge-danger">No Discount</span>
                                            @else
                                            @php
                                                    $amount=intval($item->selling_price) -
                                                    intval($item->discount_price);
                                                    $discount=($amount/intval($item->selling_price))*100;
                                                    @endphp
                                            <span class="badge badge badge-pill badge-danger">{{ round($discount) }}%</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge badge-pill badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="#"
                                                class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                            <a title="Edit Data" href="{{ route('product.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>

                                                <a title="Delete Data" href="{{ route('product.delete',$item->id) }}"
                                                id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>

                                                <!-- Product Status Update -->
                                                @if ($item->status == 1)
                                                <a title="Status Down" href="{{ route('product.inactive', $item->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-arrow-down"></i></a>
                                                @else
                                                <a title="Status Up" href="{{ route('product.active', $item->id) }}"
                                                    class="btn btn-success"><i class="fa fa-arrow-up"></i></a>
                                                @endif
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection
