@extends('userview.master')

@section('title', 'Company Contact Details Update')


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
                <h2>Company Contact Details Update <small>Update Company Contact Information</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
{{--                {!!Form::model(Auth::user(), array('url' => array('profile/contactinfo-change'),'method'=>'post', 'class'=>'form-horizontal form-label-left' ))!!}--}}
                <form action="{{url('profile/contactinfo-change')}}" method="POST" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="company_name" required="required" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('company_name')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="contact_person" required="required" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('contact_person')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="address" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('address')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">City 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="city" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('city')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State/Province 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="state" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('state')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Postal Code 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="postal_code" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('postal_code')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telephone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="telephone" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('telephone')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="fax" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('fax')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="mobile" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('mobile')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Website 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="website" class="form-control col-md-7 col-xs-12" value = "{{Auth::user()->getAttributeValue('website')}}">
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
{{--                {!! Form::close() !!}--}}
            </div>
        </div>
    </div>
</div>


@endsection

@section('customfooterscript')


@endsection