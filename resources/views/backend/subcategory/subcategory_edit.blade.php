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
                        <form method="post" action="{{ route('subcategory.update', $subcategory->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $subcategory->id }}">

                            <div class="form-group">
                                <label for="">Category Select<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control">
                                    <option value="" selected disabled>Select Your Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id === $subcategory->category_id ? 'selected' : '' }} >{{ $category->category_name_en }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Category Name English</label>
                                <input type="text" id="subcategory_name_en" value="{{ $subcategory->subcategory_name_en }}" name="subcategory_name_en" class="form-control">
                                @error('category_name_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Category Name Hindi</label>
                                <input type="text" id="subcategory_name_hin" value="{{ $subcategory->subcategory_name_hin }}" name="subcategory_name_hin" class="form-control">
                                @error('category_name_hin')
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
