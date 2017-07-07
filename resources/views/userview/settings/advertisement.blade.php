@extends('userview.master')

@section('title', 'Advertisement Settings')


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
                <h2>Change Advertisements </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="{{url('settings/advertisement')}}" method="POST" class="form-horizontal form-label-left">


                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customfooterscript')

@endsection