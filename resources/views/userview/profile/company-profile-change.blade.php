@extends('userview.master')

@section('title', 'Company Profile Details Update')


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
                    <h2>Company Profile Details Update
                        <small>Update Company Profile Information</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {{--                    {!!Form::model(Auth::user(), array('url' => array('profile/basicinfo-change'),'method'=>'post', 'class'=>'form-horizontal form-label-left' ))!!}--}}
                    <form action="{{url('profile/basicinfo-change')}}" method="POST"
                          class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <h4 class="form-title">Business Info</h4>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Business Type
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="business_type" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('business_type')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Market
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="main_market" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('main_market')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Products
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="main_products" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('main_products')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Established
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="established_year" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('established_year')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of Employees
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="total_employee" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('total_employee')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Capitalization
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="capitalization" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('capitalization')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Annual Revenue
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="revenue" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('revenue')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Registred Capital
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="capital" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('capital')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ownership Type
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="ownership" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('ownership')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Annual Sales Volume
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="sales_volume" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('sales_volume')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Export Percentage
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="export_percent" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('export_percent')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Certifications
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="certifications" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('certifications')}}">
                            </div>
                        </div>

                        @if(Auth::user()->getAttributeValue('role') != 'buyer')
                        <h4 class="form-title">Factory Info</h4>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Factory Location
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="factory_location" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('factory_location')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Factory Size
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="factory_size" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('factory_size')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of Production Lines
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="production_lines" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('production_lines')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Production Capacity
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="production_capacity" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('production_capacity')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Annual Purchase Volume
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="purchase_volume" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('purchase_volume')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of R&amp;D stuff
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="rd_stuff" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('rd_stuff')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of QC stuff
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="qc_stuff" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('qc_stuff')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Quality Control
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="quality_control" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('quality_control')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contract Manufacturing
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="contract_manufact" class="form-control col-md-7 col-xs-12"
                                       value="{{Auth::user()->getAttributeValue('contract_manufact')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">About Us
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control col-md-7 col-xs-12" name="about_us" id="" cols="30"
                                          rows="4">{{Auth::user()->getAttributeValue('about_us')}}</textarea>
                            </div>
                        </div>
                        @endif


                        <div class="form-group">
                            <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Company Logo</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="images[]" id="file" class="form-control float-left" onchange="readURL(this);">

                                <img src="{{ URL::asset('images/common-placeholder.jpg') }}" style="margin-left: 30%; padding: 10px; width: 50%;" id="blah" alt="Image">
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
{{--                    {!! Form::close() !!}--}}
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('customfooterscript')


@endsection
