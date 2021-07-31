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
                        <form method="post" action="{{ route('blog.post.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Post Name En <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="post_title_en" class="form-control"
                                                        required>
                                                </div>
                                                @error('product_name_en')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Post Name Hin <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="post_title_hin" class="form-control"
                                                        required>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Post Main Thumbnail <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="post_image" class="form-control"
                                                        onChange="mainThamUrl(this)" required>
                                                </div>
                                                @error('post_image')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <img src="" id="mainThmb" alt="">
                                            </div>
                                        </div><!-- col-md-4 end -->

                                        {{-- Category --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Blog Category Select <span class="text-danger">*</span></h5>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Your Category</option>
                                                    @foreach ($blogCategory as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->blog_category_name_en }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-4 end -->
                                    </div> <!-- 6th End Row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="post_details_en" rows="10"
                                                        cols="80"></textarea>
                                                </div>
                                                @error('post_details_en')
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
                                                    <textarea id="editor2" name="post_details_hin" rows="10"
                                                        cols="80"></textarea>
                                                </div>
                                                @error('post_details_hin')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div><!-- col-md-6 end -->
                                    </div> <!-- 8th End Row -->
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Add Blog</button>
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


<!-- Live Thumbnail Image Show -->
<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

@section('custrom_script')
<!-- CK EDITOR -->
<script src="{{ asset('backend') }}/../assets/vendor_components/ckeditor/ckeditor.js"></script>
<script src="{{ asset('backend') }}/../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
<script src="{{ asset('backend') }}/js/pages/editor.js"></script>
@endsection
@endsection
