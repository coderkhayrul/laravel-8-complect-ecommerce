@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">District List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($districts as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->division->division_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->district_name }}
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('district.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>

                                            <a title="Delete Data" href="{{ route('district.delete',$item->id) }}"
                                            id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            {{-- //////////////////////----- ADD DISTRICT -----///////////////////////// --}}
            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add District</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('district.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Division Name</label>
                                    <select name="division_id" class="form-control" required>
                                        <option value="" selected disabled>Select Your Division</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" >{{ $division->division_name }}</option>
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
                                        class="form-control">
                                    @error('district_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Insert New</button>
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
