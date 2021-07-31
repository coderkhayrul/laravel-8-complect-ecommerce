@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pending Review List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Summary</th>
                                        <th>Comment</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->summary }}
                                        </td>
                                        <td> {{ $item->comment }} </td>
                                        <td> {{ $item->user->name }} </td>
                                        <td> {{ $item->product->product_name_en }} </td>

                                        <td class="text-center">
                                            @if ($item->status == 0)
                                            <span class="badge badge-pill badge-primary">Pending</span>
                                            @else
                                            <span class="badge badge-pill badge-success">Success</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('review.approve',$item->id) }}" class="btn btn-danger"><i class="fa fa-check"></i> Approve</a>
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
