@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between">
                        <h3 class="box-title">Total Blog Post <span class="badge badge-pill badge-danger badge-sm">{{ count($blogPosts) }}</span></h3>
                        <a class="btn btn-success"href="{{ route('blog.post.add') }}">Add Post</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Post Image</th>
                                        <th>Post Category</th>
                                        <th>Post Title En</th>
                                        <th>Post Title hin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogPosts as $item)

                                    <tr>
                                        <td class="text-center">
                                            <img style=" width:60px; height: 50px;" src="{{ asset($item->post_image) }}" alt="">
                                        </td>
                                        <td>{{ $item->postCategory->blog_category_name_en }}</td>
                                        <td>{{ $item->post_title_en }}</td>
                                        <td>{{ $item->post_title_hin }}</td>
                                        <td width="20%" class="text-center">

                                            <a title="Edit Data" href="{{ route('blog.post.edit',$item->id) }}"
                                                class="btn btn-info"><i class="fa fa-edit"></i></a>

                                                <a title="Delete Data" href="{{ route('blog.post.delete',$item->id) }}"
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection
