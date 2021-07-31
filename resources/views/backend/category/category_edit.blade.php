@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row d-flex justify-content-center">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Category Edit</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('category.update', $category->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">

                            <div class="form-group">
                                <label for="">Category Name English</label>
                                <input type="text" id="category_name_en" value="{{ $category->category_name_en }}" name="category_name_en" class="form-control">
                                @error('category_name_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Category Name Hindi</label>
                                <input type="text" id="category_name_hin" value="{{ $category->category_name_hin }}" name="category_name_hin" class="form-control">
                                @error('category_name_hin')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">category Icon</label>
                                <input type="text" name="category_icon" value="{{ $category->category_icon }}" class="form-control">
                                @error('category_image')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Category</button>
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
