@extends('frontend.main_master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-2">

            </div> <!-- /.col md 2 -->

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi..... <strong>{{ Auth::user()->name }}</strong>
                            Update Your Password
                        </span>
                    </h3>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.password.update') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password <span>*</span></label>
                                <input type="password" value="" name="current_password" class="form-control" id="current_password">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New Password <span>*</span></label>
                                <input type="password" value="" name="password" class="form-control"
                                    id="password">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                                <input type="password" value="" name="password_confirmation" class="form-control"
                                    id="password_confirmation">
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div> <!-- /.col md 2 -->

        </div> <!-- /.end row -->
    </div>
</div>

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
