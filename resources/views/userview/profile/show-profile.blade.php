@extends('userview.master')

@section('title', 'My Profile')


@section('pagebody')

    @if(session('success'))
        <div class="alert alert-success" style="margin-top: 60px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check sign"></i><strong>Success!</strong> >{{session('success')}}
        </div>
    @endif

    <style>
        .form-control {
            line-height: 13.3333px;
            /*color: white;*/
        }
    </style>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Profile Details
                        >{{--<small>Update Company Profile Information</small>--}}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>

                    <form action=">{{url('profile/basicinfo-change')}}" method="POST"
                          class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Company Logo</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">


                                <img src="{!! first_image(Auth::user()->logo) !!}"
                                     style="margin-left: 22%; padding: 10px; width: 50%;" id="blah" alt="Image">
                            </div>
                        </div>
                        <h4 class="form-title">Business Info</h4>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Business Type
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="business_type" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('business_type')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Market
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="main_market" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('main_market')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Products
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="main_products" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('main_products')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Established
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="established_year" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('established_year')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of Employees
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="total_employee" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('total_employee')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Capitalization
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="capitalization" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('capitalization')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Annual Revenue
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="revenue" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('revenue')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Registred Capital
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="capital" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('capital')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ownership Type
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="ownership" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('ownership')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Annual Sales Volume
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="sales_volume" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('sales_volume')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Export Percentage
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="export_percent" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('export_percent')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Certifications
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="certifications" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('certifications')}}</label>
                            </div>
                        </div>

                        @if(Auth::user()->getAttributeValue('role') != 'buyer')
                            <h4 class="form-title">Factory Info</h4>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Factory Location
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="factory_location" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('factory_location')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Factory Size
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="factory_size" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('factory_size')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of Production Lines
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="production_lines" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('production_lines')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Production Capacity
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="production_capacity"
                                           class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('production_capacity')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Annual Purchase Volume
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="purchase_volume" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('purchase_volume')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of R&amp;D stuff
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="rd_stuff" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('rd_stuff')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">No. of QC stuff
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="qc_stuff" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('qc_stuff')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Quality Control
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="quality_control" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('quality_control')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Contract Manufacturing
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="contract_manufact" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('contract_manufact')}}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">About Us
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label name="contract_manufact" class="form-control col-md-7 col-xs-12"
                                    >{{Auth::user()->getAttributeValue('about_us')}}</label>

                                </div>
                            </div>
                        @endif


                        <h4>Conact Info</h4>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="company_name"
                                       class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('company_name')}}</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="contact_person"
                                       class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('contact_person')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="address" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('address')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">City
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="city" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('city')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">State/Province
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="state" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('state')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Postal Code
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="postal_code" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('postal_code')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Telephone
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="telephone" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('telephone')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="fax" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('fax')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label name="mobile" class="form-control col-md-7 col-xs-12"
                                >{{Auth::user()->getAttributeValue('mobile')}}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Website
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a class="form-control col-md-7 col-xs-12"
                                   href="{!! Auth::user()->getAttributeValue('website') !!} ">{!! Auth::user()->getAttributeValue('website') !!}</a>

                            </div>
                        </div>

                        <div class="ln_solid"></div>


                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('customfooterscript')


@endsection
