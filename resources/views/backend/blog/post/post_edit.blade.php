@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Blog Post</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('blog.post.update', $blogPost->id) }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blogPost->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Post Category Select <span class="text-danger">*</span></h5>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="" selected disabled>Select Post Category
                                                    </option>
                                                    @foreach ($blogPostCategory as $category)
                                                    <option value="{{ $blogPost->category_id }}"
                                                        {{ $category->id == $blogPost->category_id ? 'selected' : '' }}>
                                                        {{ $category->blog_category_name_en }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
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
                                                    <input type="text" value="{{ $blogPost->post_title_en }}"
                                                        name="post_title_en" class="form-control" required>
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
                                                    <input type="text" value="{{ $blogPost->post_title_hin }}"
                                                        name="post_title_hin" class="form-control" required>
                                                </div>
                                                @error('post_title_hin')
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
                                                <h5>Long Description English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="post_details_en" rows="10"
                                                        cols="80">
                                                        {!! $blogPost->post_details_en !!}
                                                    </textarea>
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
                                                        cols="80">
                                                        {!! $blogPost->post_details_hin !!}
                                                    </textarea>
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
                            <hr>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-primary mb-5">Update Post</button>
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

    <!-- /////////////////////////////////////////   MAIN THUMNAIL IMAGE UPDATE   ////////////////////////////// -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Post Image <strong>Update</strong></h4>
                    </div>
                    <form method="post" action="{{ route('post.image.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$blogPost->id}}">
                        <input type="hidden" name="old_image" value="{{$blogPost->post_image}}">
                        <div class="row row-sm">
                                <div class="col-md-3 d-flex justify-content-center">
                                    <br>
                                    <div class="card p-2" style="width: 300px">
                                        <img id="mainThmb" class="card-img-top" src="{{ asset($blogPost->post_image) }}"
                                            style="height: 130px;">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <div class="form-group">
                                                    <label for="" class="form-control-lable">Change Image <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="file" name="post_image" class="form-control" onChange="mainThamUrl(this)" required>
                                                    @error('post_image')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
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

@endsection
