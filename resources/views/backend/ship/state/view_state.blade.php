@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">State List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>District Name</th>
                                        <th>State Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($states as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->division->division_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->district->district_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->state_name }}
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('state.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>

                                            <a title="Delete Data" href="{{ route('state.delete',$item->id) }}"
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

            {{-- //////////////////////----- ADD COUPON -----///////////////////////// --}}
            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add State</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('state.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="">Division Select<span
                                        class="text-danger">*</span></label>
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
                                    <label for="">District Select<span
                                            class="text-danger">*</span></label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="" selected disabled>Select Your District</option>

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
                                    <input type="text" name="state_name"
                                        class="form-control">
                                    @error('state_name')
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

{{-- Get All District By Division --}}
@section('custrom_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{  url('/shipping/district/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success: function(data) {
                        console.log(data);
                       var d = $('select[name="district_id"]').empty();
                       $.each(data, function(key,value){
                        $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                       });
                    }

                });
            }else{
                alert('danger');
            }
        });
    });
</script>
@endsection

@endsection
