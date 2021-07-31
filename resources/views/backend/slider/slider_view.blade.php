@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Slider <span class="badge badge-pill badge-danger badge-sm">{{ count($sliders) }}</span></h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Slider Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $item)
                                    <tr>
                                        <td class="text-center"><img src="{{ asset($item->slider_image) }}" alt="{{ $item->brand_name_en }}" width="70px" height="40px"></td>
                                        <td>
                                            @if ($item->title == null)
                                            <span class="badge badge badge-pill badge-danger">No Title</span>
                                            @else
                                            {{ $item->title }}
                                            @endif
                                        </td>
                                        <td>@if ($item->description == null)
                                            <span class="badge badge badge-pill badge-danger">No Description</span>
                                            @else
                                            {{ $item->description }}
                                            @endif

                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge badge-pill badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a title="Edit Data" href="{{ route('slider.edit',$item->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a title="Delete Data" href="{{ route('slider.delete',$item->id) }}" id="delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <!-- Product Status Update -->
                                            @if ($item->status == 1)
                                            <a title="Status Down" href="{{ route('slider.inactive', $item->id) }}"
                                                class="btn btn-danger"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a title="Status Up" href="{{ route('slider.active', $item->id) }}"
                                                class="btn btn-success"><i class="fa fa-arrow-up"></i></a>
                                            @endif
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

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" id="title" name="title" class="form-control">
                                    @error('title')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="textarea" class="form-control"></textarea>
                                    @error('description')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Slider Image</label>
                                    <input type="file" name="slider_image" class="form-control">
                                    @error('slider_image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Insert Slider</button>
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
