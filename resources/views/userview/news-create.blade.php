@extends('userview.master')

@section('title', 'News Create')
<script src="//cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>


@section('pagebody')
@if(session('success'))
<div class="alert alert-success" style="margin-top: 60px;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <i class="fa fa-check sign"></i><strong>Success!</strong> {{session('success')}}
</div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Create News</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{url('post/news-create')}}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-2 col-xs-12">News Title <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-7 col-xs-12">
                            <input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12">
                        </div>

                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <button type="submit" class="btn btn-success">Save News</button>
                        </div>

                    </div>

                    <div class="form-group">
                        <textarea name="post" id="editor" cols="30" rows="10"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customfooterscript')
    <script>
        CKEDITOR.replace('editor', {
            filebrowserImageBrowseUrl: '../elfinder/ckeditor',
            filebrowserBrowseUrl: '../elfinder/ckeditor'

        });
    </script>
@endsection