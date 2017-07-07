@extends('userview.master')

@section('title', 'Social Link Settings')


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
                <h2>Change Social Links</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{url('settings/social')}}" method="POST" class="form-horizontal form-label-left">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" name="email" class="form-control col-md-7 col-xs-12" value="{{$email}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Facebook
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="facebook" class="form-control col-md-7 col-xs-12" value="{{$facebook}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Google Plus
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="googleplus" class="form-control col-md-7 col-xs-12" value="{{$googleplus}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Twitter
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="twitter" class="form-control col-md-7 col-xs-12" value="{{$twitter}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Linked In
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="linkedin" class="form-control col-md-7 col-xs-12" value="{{$linkedin}}">
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
