@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Blog Category <span class="badge badge-pill badge-danger badge-sm">{{ count($blogCategory) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Blog Category En</th>
                                        <th>Blog Category Hin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogCategory as $item)
                                    <tr>
                                        <td>{{ $item->blog_category_name_en }}</td>
                                        <td>{{ $item->blog_category_name_hin }}</td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('blog.category.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a title="Delete Data" href="{{ route('blog.category.delete',$item->id) }}"
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

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Blog Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('blog.category.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Blog Category Name English <span class="text-danger">*</span></label>
                                    <input type="text" id="blog_category_name_en" name="blog_category_name_en"
                                        class="form-control">
                                    @error('blog_category_name_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Blog Category Name Hindi <span class="text-danger">*</span></label>
                                    <input type="text" id="blog_category_name_hin" name="blog_category_name_hin"
                                        class="form-control">
                                    @error('blog_category_name_hin')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add New</button>
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
