@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Category <span class="badge badge-pill badge-danger badge-sm">{{ count($categories) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Category Icon</th>
                                        <th>Category En</th>
                                        <th>Category Hin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-center">
                                            <i class="{{ $category->category_icon }} fa-4x"></i>
                                        </td>
                                        <td>{{ $category->category_name_en }}</td>
                                        <td>{{ $category->category_name_hin }}</td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('category.edit',$category->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a title="Delete Data" href="{{ route('category.delete',$category->id) }}"
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
                        <h3 class="box-title">All Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('category.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Category Name English</label>
                                    <input type="text" id="category_name_en" name="category_name_en"
                                        class="form-control">
                                    @error('category_name_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Category Name Hindi</label>
                                    <input type="text" id="category_name_hin" name="category_name_hin"
                                        class="form-control">
                                    @error('category_name_hin')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Category Icon</label>
                                    <input type="text" name="category_icon" class="form-control">
                                    @error('category_icon')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Insert Category</button>
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
