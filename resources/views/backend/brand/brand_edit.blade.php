@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row d-flex justify-content-center">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Brand List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $brand->id }}">
                            <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">

                            <div class="form-group">
                                <label for="">Brand Name English</label>
                                <input type="text" id="brand_name_en" value="{{ $brand->brand_name_en }}" name="brand_name_en" class="form-control">
                                @error('brand_name_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Brand Name Hindi</label>
                                <input type="text" id="brand_name_hin" value="{{ $brand->brand_name_hin }}" name="brand_name_hin" class="form-control">
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
                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </div>
                        </form>
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
