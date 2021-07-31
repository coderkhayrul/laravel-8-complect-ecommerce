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
                            Update Your Profile
                        </span>
                    </h3>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                <input type="name" value="{{ $user->name }}" name="name" class="form-control" id="name">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" value="{{ $user->email }}" name="email" class="form-control"
                                    id="email">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                                <input type="text" value="{{ $user->phone }}" name="phone" class="form-control"
                                    id="phone">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">User Image <span>*</span></label>
                                <input type="file" id="image" name="profile_photo_path" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update Profile</button>
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
