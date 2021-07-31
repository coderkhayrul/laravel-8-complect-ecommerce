@extends('admin.admin_master')

@section('admin_index')
<section class="content">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Seo Setting Page</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="post" action="{{ route('update.seo.setting') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $seo->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Meta Title</label>
                                            <input type="text" value="{{ $seo->meta_title }}" name="meta_title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Meta Author</label>
                                            <input type="text" name="meta_author" value="{{ $seo->meta_author }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Meta keyword</label>
                                            <input type="text" name="meta_keyword" value="{{ $seo->meta_keyword }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Mete Description</label>
                                            <textarea name="meta_description" class="form-control" >{{ $seo->meta_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Google Analytics</label>
                                            <textarea name="google_analytics" class="form-control" >{{ $seo->google_analytics }}</textarea>
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
