@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row d-flex justify-content-center">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Category Edit</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('blog.category.update', $blogCategory->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blogCategory->id }}">

                            <div class="form-group">
                                <label for="">Category Name English</label>
                                <input type="text" id="blog_category_name_en" value="{{ $blogCategory->blog_category_name_en }}" name="blog_category_name_en" class="form-control">
                                @error('category_name_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Category Name Hindi</label>
                                <input type="text" id="blog_category_name_hin" value="{{ $blogCategory->blog_category_name_hin }}" name="blog_category_name_hin" class="form-control">
                                @error('category_name_hin')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Blog Category</button>
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
