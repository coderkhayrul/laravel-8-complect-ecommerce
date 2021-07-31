@extends('admin.admin_master')

@section('admin_index')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Admin Profile Edit</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="post" action="{{ route('update.profile.password') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="">Current Password</label>
                                            <input type="password" id="current_password" name="current_password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="">New Password</label>
                                            <input type="password" id="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="">Confirm Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection
