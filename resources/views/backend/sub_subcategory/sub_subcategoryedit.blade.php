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
                        <form method="post" action="{{ route('subsubcategory.update', $subsubcategories->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $subsubcategories->id }}">
                            <div class="form-group">
                                <label for="">Category Select<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control">
                                    <option value="" selected disabled>Select Your Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id === $subsubcategories->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Sub Category Select<span class="text-danger">*</span></label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="" selected disabled>Select Your SubCategory</option>
                                    @foreach ($subcategories as $subsub)
                                    <option value="{{ $subsub->id }}" {{ $subsub->id === $subsubcategories->subcategory_id ? 'selected' : ''}}>
                                        {{ $subsub->subcategory_name_en }}
                                    </option>
                                    @endforeach

                                </select>
                                @error('subcategory_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Sub SubCategory Name English <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $subsubcategories->subsubcategory_name_en }}" id="subsubcategory_name_en" name="subsubcategory_name_en"
                                    class="form-control">
                                @error('subcategory_name_en')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Sub SubCategory Name Hindi <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $subsubcategories->subsubcategory_name_hin }}" id="subsubcategory_name_hin" name="subsubcategory_name_hin"
                                    class="form-control">
                                @error('subcategory_name_hin')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Data</button>
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
