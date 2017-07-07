@extends('userview.master')

@section('title', 'Category Create')


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
                <h2>Create New Category <small>Create Multi-level Product Categories</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{url('category/create')}}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Level <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="level" id="category-level" class="form-control col-md-5 col-xs-12">
                                <option value="1" selected="true">Main Category</option>
                                <option value="2">Sub Category</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="main-category-list">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parent Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="parent" id="" class="form-control col-md-5 col-xs-12">
                                <option value="0" selected="true" disabled="true">--- Select a Parent Category ---</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="category_image">
                        <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Category Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="image" id="file" class="form-control float-left" onchange="readURL(this);">

                            <img src="{{ URL::asset('images/common-placeholder.jpg') }}" style="margin-left: 10%; padding: 10px; width: 50%" id="blah" alt="Image">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customfooterscript')

<script>
    jQuery(document).ready(function($) {
        $('#main-category-list').hide();
        $('#category-level').val('1');
        $('#main-category-list').val('0');

        $(document).on('change','#category-level',function(){
            $val = $(this).val();

            if($val == '2')
            {
                $('#main-category-list').show();
                $('#category_image').hide();
            }
            else
            {
                $('#main-category-list').hide();
                $('#category_image').show();
            }
        });

    });
</script>

<!-- image preview script-->
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection