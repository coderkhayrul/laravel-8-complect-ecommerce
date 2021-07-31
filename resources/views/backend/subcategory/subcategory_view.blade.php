@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Sub Category <span class="badge badge-pill badge-danger badge-sm">{{ count($subcategories) }}</span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Sub Category En</th>
                                        <th>Sub Category Hin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td class="text-center"> {{ $subcategory['category']['category_name_en'] }} </td>
                                        <td>{{ $subcategory->subcategory_name_en }}</td>
                                        <td>{{ $subcategory->subcategory_name_hin }}</td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('subcategory.edit',$subcategory->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a title="Delete Data"
                                                href="{{ route('subcategory.delete',$subcategory->id) }}" id="delete"
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

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Sub Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('subcategory.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Category Select<span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control">
                                        <option value="" selected disabled>Select Your Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name_en }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Category Name English <span class="text-danger">*</span></label>
                                    <input type="text" id="subcategory_name_en" name="subcategory_name_en"
                                        class="form-control">
                                    @error('subcategory_name_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Category Name Hindi <span class="text-danger">*</span></label>
                                    <input type="text" id="subcategory_name_hin" name="subcategory_name_hin"
                                        class="form-control">
                                    @error('subcategory_name_hin')
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
