@extends('userview.master')

<?php $type = \App\Post::find($id)->type;?>
@section('title', "Update ".ucfirst($type))

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
                    <h2>Edit {{ucfirst(\App\Post::find($id)->type )}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <form action="{{url('post/update',$id)}}" method="POST" class="form-horizontal form-label-left"
                          enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left">{{ucfirst(\App\Post::find($id)->type )}}
                                Title <span class="required">*</span>
                            </label>

                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" name="title" id="title" required="required"
                                       class="form-control col-md-7 col-xs-12"
                                       value="{{\App\Post::where('id',$id)->value('title')}}">
                            </div>

                            <div class="col-md-2 col-sm-3 col-xs-12">
                                <button type="submit" class="btn btn-success">
                                    Update {{ucfirst(\App\Post::find($id)->type )}}</button>
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="post" id="editor" cols="30" rows="10">{{\App\Post::where('id',$id)->value('post')}}</textarea>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12" style="border: 1px solid #ABABAB;">
                            <label for="image" class="text-center col-md-12 col-sm-12 col-xs-12" style="font-size: 16px; margin-bottom: 20px;">Featured Image</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="file" name="featured_image" id="file" class="form-control float-left" onchange="readURL(this);">
                                <?php
                                      $image = \App\Post::where('id',$id)->value('featured_image');
                                      if($image == null)
                                        $image = 'images/common-placeholder.jpg';

                                ?>
                                <img src="{{ URL::asset($image) }}" style="padding: 10px; width: 100%;" id="blah" alt="Image">
                            </div>
                          </div>
                        </div>

                        {{--<input type="hidden" name="type" value="{{(\App\Post::find($id)->value('type') )}}">--}}
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customfooterscript')
    <script>
        CKEDITOR.replace('editor', {
            filebrowserImageBrowseUrl: '../../elfinder/ckeditor',
            filebrowserBrowseUrl: '../../elfinder/ckeditor'

        });
    </script>

    <!-- image preview script-->
    <script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
