@extends('admin.admin_master')

@section('admin_index')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Admin User Create</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Admin User Name </label>
                                            <input type="text" name="name"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Admin Email</label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Admin User Phone </label>
                                            <input type="text" name="phone"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Admin Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Admin User Image</label>
                                            <input type="file" id="image" name="profile_photo_path" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                           <img width="120px" height="100px" id="showImage" src="{{ url('upload/no_image.jpg') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" name="brand" id="checkbox_2" value="1">
                                                    <label for="checkbox_2">Brand</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="category" id="checkbox_3" value="1">
                                                    <label for="checkbox_3">Category</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="product" id="checkbox_4" value="1">
                                                    <label for="checkbox_4">Product</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="slider" id="checkbox_5" value="1">
                                                    <label for="checkbox_5">Slider</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="coupon" id="checkbox_6" value="1">
                                                    <label for="checkbox_6">Coupon</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" name="shipping" id="checkbox_7" value="1">
                                                    <label for="checkbox_7">Shipping</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="blog" id="checkbox_8" value="1">
                                                    <label for="checkbox_8">Blog</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="setting" id="checkbox_9" value="1">
                                                    <label for="checkbox_9">Setting</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="returnorder" id="checkbox_10" value="1">
                                                    <label for="checkbox_10">Return Order</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="review" id="checkbox_11" value="1">
                                                    <label for="checkbox_11">Review</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" name="orders" id="checkbox_12" value="1">
                                                    <label for="checkbox_12">Orders</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="stock" id="checkbox_13" value="1">
                                                    <label for="checkbox_13">Stock</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="reports" id="checkbox_14" value="1">
                                                    <label for="checkbox_14">Reports</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="alluser" id="checkbox_15" value="1">
                                                    <label for="checkbox_15">All User</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" name="adminuserrole" id="checkbox_16" value="1">
                                                    <label for="checkbox_16">Admin User Role</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Add Admin User</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>

<script type="text/javascript">

    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
