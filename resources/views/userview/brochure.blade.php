@extends('userview.master')

@section('title', 'Company Brochure')

@section('pagebody')

@if(session('success'))
<div class="alert alert-success" style="margin-top: 60px;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <i class="fa fa-check sign"></i><strong>Success!</strong> {{session('success')}}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger" style="margin-top: 60px;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <i class="fa fa-time sign"></i><strong>Error!</strong> {{session('error')}}
</div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Company Brochure <small>Upload your company brochure for public view</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{url('profile/brochure')}}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

                  @if($free)
                  <div class="notavailable" style="color: rgb(240, 152, 152);">
                    <h1>Please upgrade your account to upload brochure.</h1>
                  </div>
                  @else
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Company Brochure</label>
                        <div class="col-md-8 col-sm-9 col-xs-12">
                            <input type="file" required name="file" id="file" class="form-control float-left" onchange="readURL(this);">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>

                    <div class="form-group">
                      @if($brochure)
                        <div class="col-md-12" style="text-align: center;">
                            <embed src="{{URL::asset($brochure)}}" width="500" height="350" type='application/pdf'>
                        </div>
                      @else
                      <div class="notavailable">
                        <h1>No Brochure Uploaded Yet</h1>
                      </div>
                      @endif
                    </div>
                  @endif
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
