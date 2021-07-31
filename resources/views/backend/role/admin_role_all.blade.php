@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between">
                        <h3 class="box-title">Total Admin Users</h3>
                        <a class="btn btn-danger" href="{{ route('add.admin') }}">Add Admin User</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Access</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adminuser as $item)
                                    <tr>
                                        <td class="text-center">
                                           <img width="75px" height="75px" src="{{ asset($item->profile_photo_path) }}" alt="">
                                        </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->email }} </td>
                                        <td>
                                            @if ($item->brand == 1)
                                            <span class="badge btn-primary">Brand</span>
                                            @else
                                            @endif

                                            @if ($item->category == 1)
                                            <span class="badge btn-secondary">Category</span>
                                            @else
                                            @endif

                                            @if ($item->product == 1)
                                            <span class="badge btn-success">Product</span>
                                            @else
                                            @endif

                                            @if ($item->slider == 1)
                                            <span class="badge btn-danger">Slider</span>
                                            @else
                                            @endif

                                            @if ($item->coupon == 1)
                                            <span class="badge btn-warning">Coupon</span>
                                            @else
                                            @endif

                                            @if ($item->shipping == 1)
                                            <span class="badge btn-info">Shipping</span>
                                            @else
                                            @endif

                                            @if ($item->blog == 1)
                                            <span class="badge btn-light">Blog</span>
                                            @else
                                            @endif
                                            @if ($item->setting == 1)
                                            <span class="badge btn-dark">setting</span>
                                            @else
                                            @endif

                                            @if ($item->returnorder == 1)
                                            <span class="badge btn-primary">Return Order</span>
                                            @else
                                            @endif

                                            @if ($item->review == 1)
                                            <span class="badge btn-secondary">Review</span>
                                            @else
                                            @endif

                                            @if ($item->orders == 1)
                                            <span class="badge btn-success">Orders</span>
                                            @else
                                            @endif

                                            @if ($item->stock == 1)
                                            <span class="badge btn-danger">Stock</span>
                                            @else
                                            @endif

                                            @if ($item->reports == 1)
                                            <span class="badge btn-warning">Reports</span>
                                            @else
                                            @endif

                                            @if ($item->alluser == 1)
                                            <span class="badge btn-info">All Users</span>
                                            @else
                                            @endif

                                            @if ($item->adminuserrole == 1)
                                            <span class="badge btn-primary">Admin User Role</span>
                                            @else
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a title="Edit" href="{{ route('edit.admin.user', $item->id) }}"
                                                class="btn btn-success"><i class="fa fa-edit"></i></a>

                                            <a id="delete" href="{{ route('admin.user.delete',$item->id) }}" title="Delete"
                                            class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
