@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Division List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($divisions as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->division_name }}
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('division.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>

                                            <a title="Delete Data" href="{{ route('division.delete',$item->id) }}"
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
                        <h3 class="box-title">Add Division</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('division.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Division Name</label>
                                    <input type="text" name="division_name"
                                        class="form-control">
                                    @error('division_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Insert New</button>
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
