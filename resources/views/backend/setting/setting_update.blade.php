@extends('admin.admin_master')

@section('admin_index')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Site Setting Page</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="post" action="{{ route('update.site.setting') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $setting->id }}">
                        <input type="hidden" name="old_image" value="{{ $setting->logo }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Site Logo</label>
                                            <input type="file" name="logo" class="form-control mb-2">
                                            <img width="139px" height="36px" src="{{ asset($setting->logo) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Phone One</label>
                                            <input type="text" value="{{ $setting->phone_one }}" name="phone_one" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Phone Two</label>
                                            <input type="text" name="phone_two" value="{{ $setting->phone_two }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" value="{{ $setting->email }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Company Name</label>
                                            <input type="text" name="company_name" value="{{ $setting->company_name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Company Address</label>
                                            <input type="text" name="company_address" value="{{ $setting->company_address }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" name="facebook" value="{{ $setting->facebook }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Twitter</label>
                                            <input type="text" name="twitter" value="{{ $setting->twitter }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">LinkedIn</label>
                                            <input type="text" name="linkedin" value="{{ $setting->linkedin }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Youtube</label>
                                            <input type="text" name="youtube" value="{{ $setting->youtube }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update Setting</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
