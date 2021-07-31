@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row d-flex justify-content-center">


            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add State</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('state.update',$state->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Division Select<span
                                        class="text-danger">*</span></label>
                                    <select name="division_id" class="form-control" required>
                                        <option value="" selected disabled>Select Your Division</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" {{ $division->id == $state->division_id ? 'selected' : ''}} >{{ $division->division_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">District Select<span
                                            class="text-danger">*</span></label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="" selected disabled>Select Your District</option>
                                        @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $district->id == $state->district_id ? 'selected' : ''}} >{{ $district->district_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('district_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">State Name<span
                                        class="text-danger">*</span></label>
                                    <input type="text" name="state_name" class="form-control" value="{{ $state->state_name }}">
                                    @error('state_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update State</button>
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
