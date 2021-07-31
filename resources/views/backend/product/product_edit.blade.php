@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Product</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('product-update', $product->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id}}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Brand Select<span class="text-danger">*</span></label>
                                                <select name="brand_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Brand</option>
                                                    @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name_en }}
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Category Select<span class="text-danger">*</span></label>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Sub Category Select<span
                                                        class="text-danger">*</span></label>
                                                <select name="subcategory_id" id="subcategory_id" class="form-control"
                                                    required>
                                                    <option value="" selected disabled>Select Your Sub Category</option>
                                                    @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                                        {{ $subcategory->subcategory_name_en }}</option>
                                                    @endforeach

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
                                                    @foreach ($subsubcategories as $subsubcategory)
                                                    <option value="{{ $subsubcategory->id }}"
                                                        {{ $subsubcategory->id == $product->subsubcategory_id ? 'selected' : '' }}>
                                                        {{ $subsubcategory->subsubcategory_name_en }}</option>
                                                    @endforeach
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
                                                    <input type="text" value="{{ $product->product_name_en }}"
                                                        name="product_name_en" class="form-control" required>
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
                                                    <input type="text" value="{{ $product->product_name_hin }}"
                                                        name="product_name_hin" class="form-control" required>
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
                                                    <input type="text" value="{{ $product->product_code }}"
                                                        name="product_code" class="form-control" required>
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
                                                    <input type="text" value="{{ $product->product_qty }}"
                                                        name="product_qty" class="form-control" required>
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
                                                        value="{{ $product->product_tag_en }}" data-role="tagsinput"
                                                        required>
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
                                                        value="{{ $product->product_tag_hin }}" data-role="tagsinput"
                                                        required>
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
                                                        value="{{ $product->product_size_en }}" data-role="tagsinput">
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
                                                        value="{{ $product->product_size_hin }}" data-role="tagsinput">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" class="form-control"
                                                        value="{{ $product->product_color_en }}" data-role="tagsinput"
                                                        required>
                                                </div>
                                                @error('product_color_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-6 end -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Color Hin <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_hin" class="form-control"
                                                        value="{{ $product->product_color_hin }}" data-role="tagsinput"
                                                        required>
                                                </div>
                                                @error('product_color_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-6 end -->

                                    </div> <!-- 5th End Row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $product->selling_price }}"
                                                        name="selling_price" class="form-control" required>
                                                </div>
                                                @error('selling_price')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-6 end -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" value="{{ $product->discount_price }}"
                                                        name="discount_price" class="form-control">
                                                </div>
                                                @error('discount_price')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div> <!-- col-md-6 end -->
                                    </div> <!-- 6th End Row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_description_en" class="form-control" required>
                                                        {!! $product->short_description_en !!}
                                                    </textarea>
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
                                                    <textarea name="short_description_hin" class="form-control"
                                                        required>
                                                        {!! $product->short_description_hin !!}
                                                    </textarea>
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
                                                        cols="80">
                                                        {!! $product->long_description_en !!}
                                                    </textarea>
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
                                                        cols="80">
                                                        {!! $product->long_description_hin !!}
                                                    </textarea>
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
                                                <input type="checkbox" name="hot_deals" id="checkbox_2" value="1"
                                                    {{ $product->hot_deals === 1 ? 'checked' : '' }}>
                                                <label for="checkbox_2">Hot Deals</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" name="featured" id="checkbox_3" value="1"
                                                    {{ $product->featured === 1 ? 'checked' : '' }}>
                                                <label for="checkbox_3">Freatured</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <fieldset>
                                                <input type="checkbox" name="special_offer" id="checkbox_4" value="1"
                                                    {{ $product->special_offer === 1 ? 'checked' : '' }}>
                                                <label for="checkbox_4">Special Offer</label>
                                            </fieldset>
                                            <fieldset>
                                                <input type="checkbox" name="special_deals" id="checkbox_5" value="1"
                                                    {{ $product->special_deals === 1 ? 'checked' : '' }}>
                                                <label for="checkbox_5">Special Deals</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Update Product</button>
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

    <!-- /////////////////////////////////////////   MULTIPLE IMAGE UPDATE   ////////////////////////////// -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                    </div>
                    <form method="post" action="{{ route('update.multi.image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            @foreach ($multiimages as $img)
                                <div class="col-md-3 d-flex justify-content-center">
                                    <br>
                                    <div class="card p-2" style="width: 300px">
                                        <img class="card-img-top" src="{{ asset($img->photo_name) }}"
                                            style="height: 130px;">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('product.multiimage.delete', $img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i
                                                        class="fa fa-trash"></i></a>
                                            </h5>
                                            <p class="card-text">
                                                <div class="form-group">
                                                    <label for="" class="form-control-lable">Change Image <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="file" class="form-control" name="multi_img[{{ $img->id }}]">
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div> <!-- col-md-3 -->
                            @endforeach
                        </div><!-- row row-sm -->
                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-rounded btn-primary ml-4">Update Image</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- /////////////////////////////////////////   MAIN THUMNAIL IMAGE UPDATE   ////////////////////////////// -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thumbnail Image <strong>Update</strong></h4>
                    </div>
                    <form method="post" action="{{ route('update.product.image') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="old_image" value="{{$product->product_thambnail}}">
                        <div class="row row-sm">
                                <div class="col-md-3 d-flex justify-content-center">
                                    <br>
                                    <div class="card p-2" style="width: 300px">
                                        <img id="mainThmb" class="card-img-top" src="{{ asset($product->product_thambnail) }}"
                                            style="height: 130px;">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <div class="form-group">
                                                    <label for="" class="form-control-lable">Change Image <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)" required>
                                                    @error('product_thambnail')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                    {{-- <img src="" id="mainThmb" alt=""> --}}
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                </div> <!-- col-md-3 -->
                        </div><!-- row row-sm -->
                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-rounded btn-primary ml-4">Update Image</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

@section('custrom_script')
    <!-- CK EDITOR -->
	<script src="{{ asset('backend') }}/../assets/vendor_components/ckeditor/ckeditor.js"></script>
	<script src="{{ asset('backend') }}/../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
	<script src="{{ asset('backend') }}/js/pages/editor.js"></script>
@endsection

<!-- Live Thumbnail Image Show -->
<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mainThmb').attr('src', e.target.result).width(300).height(130);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<!-- Live Multiple Image Show -->
<script>
    $(document).ready(function () {
        $('#multiImg').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(80)
                                    .height(80); //create image element
                                $('#preview_img').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });

</script>
@endsection
