@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row d-flex justify-content-center">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update District</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('district.update',$district->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Division Name</label>
                                    <select name="division_id" class="form-control" required>
                                        <option value="" selected disabled>Select Your Division</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" {{ $division->id == $district->division_id ? 'selected' : ''}} >{{ $division->division_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">District Name</label>
                                    <input type="text" name="district_name"
                                        class="form-control" value="{{ $district->district_name }}">
                                    @error('district_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update District</button>
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

@endsection
