@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Brand <span class="badge badge-pill badge-danger badge-sm">{{ count($brands) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Brand En</th>
                                        <th>Brand Hin</th>
                                        <th>Brand Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->brand_name_en }}</td>
                                        <td>{{ $brand->brand_name_hin }}</td>
                                        <td class="text-center"><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name_en }}" width="70px" height="40px"></td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('brand.edit',$brand->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a title="Delete Data" href="{{ route('brand.delete',$brand->id) }}" id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Brand Name English</label>
                                    <input type="text" id="brand_name_en" name="brand_name_en" class="form-control">
                                    @error('brand_name_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Brand Name Hindi</label>
                                    <input type="text" id="brand_name_hin" name="brand_name_hin" class="form-control">
                                    @error('brand_name_hin')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control">
                                    @error('brand_image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Insert Brand</button>
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
