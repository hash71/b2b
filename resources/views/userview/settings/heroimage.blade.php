@extends('userview.master')

@section('title', 'Brand Image Settings')


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
                <h2>Change Homepage Brand Image <small>Use minimum height of the image 500px for better view</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{url('settings/heroimage')}}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

                    <div class="form-group" id="category_image">
                        <label for="image" class="control-label col-md-2 col-sm-3 col-xs-12">Brand Image</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                            <input type="file" required name="image" id="file" class="form-control float-left" onchange="readURL(this);">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>

                    <div class="form-group">
                      @if($image)
                        <div class="col-md-12" style="text-align: center;">
                            <img src="{{ URL::asset($image) }}" style="padding: 10px; width:100%; height: 500px" id="blah" alt="Image Preview">
                        </div>
                      @else
                      <div class="notavailable">
                        <h1>No Image Available</h1>
                      </div>
                      @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customfooterscript')

<!-- image preview script-->
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .height(500);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
