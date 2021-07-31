@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Product</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('product-store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            {{-- Brand --}}
                                            <div class="form-group">
                                                <label for="">Brand Select<span class="text-danger">*</span></label>
                                                <select name="brand_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Brand</option>
                                                    @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-4 end -->
                                        {{-- Category --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Category Select<span class="text-danger">*</span></label>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->category_name_en }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        {{-- Sub Category --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Sub Category Select<span
                                                        class="text-danger">*</span></label>
                                                <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Sub Category</option>

                                                </select>
                                                @error('subcategory_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                    </div> <!-- 1st End Row -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Sub SubCategory Select<span
                                                        class="text-danger">*</span></label>
                                                <select name="subsubcategory_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Sub Sub-Category
                                                    </option>
                                                </select>
                                                @error('subsubcategory_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control" required>
                                                </div>
                                                @error('product_name_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name Hin <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_hin" class="form-control" required>
                                                </div>
                                                @error('product_name_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                    </div> <!-- 2st End Row -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Code <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control" required>
                                                </div>
                                                @error('product_code')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control" required>
                                                </div>
                                                @error('product_qty')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tag En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tag_en" class="form-control"
                                                        data-role="tagsinput" required>
                                                </div>
                                                @error('product_tag_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                    </div> <!-- 3rd End Row -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tag Hin <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tag_hin" class="form-control"
                                                        data-role="tagsinput" required>
                                                </div>
                                                @error('product_tag_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en" class="form-control"
                                                        value="Small,Midium,Large" data-role="tagsinput">
                                                </div>
                                                @error('product_size_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size Hin <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_hin" class="form-control"
                                                        value="Small,Midium,Large" data-role="tagsinput">
                                                </div>
                                                @error('product_size_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                    </div> <!-- 4th End Row -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" class="form-control"
                                                        value="red,black,blue" data-role="tagsinput" required>
                                                </div>
                                                @error('product_color_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color Hin <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_hin" class="form-control"
                                                        value="red,black,blue" data-role="tagsinput" required>
                                                </div>
                                                @error('product_color_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="selling_price"
                                                        class="form-control" required>
                                                </div>
                                                @error('selling_price')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                    </div> <!-- 5th End Row -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="discount_price"
                                                        class="form-control">
                                                </div>
                                                @error('discount_price')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Porduct Main Thumbnail <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thambnail" class="form-control"
                                                        onChange="mainThamUrl(this)" required>
                                                </div>
                                                @error('product_thambnail')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <img src="" id="mainThmb" alt="">
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Multiple Image<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" id="multiImg" name="multi_img[]" class="form-control" multiple="">
                                                </div>
                                                @error('multi_img')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <div class="row" id="preview_img">
                                                </div>

                                            </div>
                                        </div><!-- col-md-4 end -->
                                    </div> <!-- 6th End Row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_description_en"
                                                        class="form-control" required></textarea>
                                                </div>
                                                @error('short_description_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-6 end -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description Hindi <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_description_hin"
                                                        class="form-control" required></textarea>
                                                </div>
                                                @error('short_description_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-6 end -->
                                    </div> <!-- 7th End Row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_description_en" rows="10"
                                                        cols="80"></textarea>
                                                </div>
                                                @error('short_description_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-6 end -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description Hindi <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_description_hin" rows="10"
                                                        cols="80"></textarea>
                                                </div>
                                                @error('short_description_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-6 end -->
                                    </div> <!-- 8th End Row -->
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" name="hot_deals" id="checkbox_2" value="1">
                                                <label for="checkbox_2">Hot Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" name="featured" id="checkbox_3" value="1">
                                                <label for="checkbox_3">Freatured</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" name="special_offer" id="checkbox_4" value="1">
                                                <label for="checkbox_4">Special Offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" name="special_deals" id="checkbox_5" value="1">
                                                <label for="checkbox_5">Special Deals</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Add Product</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<!-- DYNAMIC CATEGORY SHOW -->
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{  url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        // <!-- SUB SUB CATEGORY GET -->

        $('select[name="subcategory_id"]').on('change', function () {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/" +
                        subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subsubcategory_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });

</script>

<!-- Live Thumbnail Image Show -->
<script type="text/javascript">

    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

 <!-- Live Multiple Image Show -->
 <script>

    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });

</script>

@section('custrom_script')
    <!-- CK EDITOR -->
	<script src="{{ asset('backend') }}/../assets/vendor_components/ckeditor/ckeditor.js"></script>
	<script src="{{ asset('backend') }}/../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
	<script src="{{ asset('backend') }}/js/pages/editor.js"></script>
@endsection
@endsection
