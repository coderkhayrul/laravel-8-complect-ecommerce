@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Sub SubCategory <span class="badge badge-pill badge-danger badge-sm">{{ count($subsubcategories) }}</span></h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Sub Sub Category En</th>
                                        <th>Sub Sub Category Hin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subsubcategories as $item)
                                    <tr>
                                        <td class="text-center"> {{ $item['category']['category_name_en'] }} </td>
                                        <td class="text-center"> {{ $item['subcategory']['subcategory_name_en'] }} </td>
                                        <td>{{ $item->subsubcategory_name_en }}</td>
                                        <td>{{ $item->subsubcategory_name_hin }}</td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('subsubcategory.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a title="Delete Data"
                                                href="{{ route('subsubcategory.delete',$item->id) }}" id="delete"
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
                        <h3 class="box-title">Create Sub Sub Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('subsubcategory.store') }}">
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
                                    <label for="">Sub Category Select<span class="text-danger">*</span></label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        <option value="" selected disabled>Select Your SubCategory</option>

                                    </select>
                                    @error('subcategory_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Sub SubCategory Name English <span class="text-danger">*</span></label>
                                    <input type="text" id="subsubcategory_name_en" name="subsubcategory_name_en"
                                        class="form-control">
                                    @error('subcategory_name_en')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Sub SubCategory Name Hindi <span class="text-danger">*</span></label>
                                    <input type="text" id="subsubcategory_name_hin" name="subsubcategory_name_hin"
                                        class="form-control">
                                    @error('subcategory_name_hin')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Insert Data</button>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });

</script>

<script type="text/javascript">
$(document).ready(function() {
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                    var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                },
            });
        } else {
            alert('danger');
        }
    });
});
</script>

@endsection
