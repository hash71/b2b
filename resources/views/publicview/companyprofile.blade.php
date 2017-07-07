@extends('publicview.master')

@section('title', 'Home')


@section('pagebody')

            @include('publicview.commonsearchbar')

            <div class="row mrgB10 company_brand_name">
                <img class="back" src="{{url('images/header.jpg')}}" alt="">
                <div class="row company_brand_layer">
                  <div class="col-md-10">
                    <div class="col-md-2" style="position: relative">
                      <img class="logo" src="{{URL::asset(first_image($company->logo))}}" alt="">
                    </div>

                    <div class="col-md-10" style="color: #fff; padding-left: 0px;">
                      <h2> {{$company->company_name}}</h2>
                      <?php $country = strtolower(array_search($company->country, country_list()));?>
                      <p> <span class="{{"flag-icon flag-icon-".$country}}"></span> {{$company->country}} </p>
                    </div>
                  </div>

                  <div class="col-md-2 pull-right">
                    @if($company->premium_gold_supplier == 1)
                    <img class="pull-right" src="{{url('images/gold.jpg')}}" alt="">
                    @elseif($company->gold_supplier == 1)
                    <img class="pull-right" src="{{url('images/premiumgold.jpg')}}" alt="">
                    @endif

                    <a style="margin-top: 5px; font-size: 13px;" class="btn btn-default btn-blue" href="{{url()}}">Contact this supplier <i class="fa fa-angle-right"></i></a>
                  </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-2 single-element sidebarmenu" style="padding: 0px;">
                    <div class="left-sidebar">
                        <div class="sidebar profilesidebar">
                            <ul class=" nav nav-tabs" style="display: block; position: static;">

                                <li class="active"><a href="#companyprofile" data-toggle="tab">Supplier Profile <i class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="#products" data-toggle="tab">Products List <i class="fa fa-angle-right pull-right"></i></a></li>
                                <!-- <li><a href="#contact" data-toggle="tab">Contact Details <i class="fa fa-angle-right pull-right"></i></a></li> -->
                                <li><a href="#brochure" data-toggle="tab">Brochure Catalog <i class="fa fa-angle-right pull-right"></i></a></li>

                                <li><a href="#" data-toggle="tab">Trust Point ({{$company->trust_profile}})</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-sm-8 padding-right">

                    <div class="recommended_items single-element"><!--recommended_items-->

                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="companyprofile" >
                                <h2 class="title text-center">Company Profile</h2>
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-body">
                                            <ul class="sinlge-post-meta">
                                                <li><i class="fa fa-user"></i>About Us</li>
                                            </ul>
                                            <p>{{$company->about_us}}</p>

                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-body">
                                            <ul class="sinlge-post-meta">
                                                <li><i class="fa fa-user"></i>Business Information</li>

                                            </ul>
                                            <div class="form-horizontal">
                                                <div class="content">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Business Type</label>
                                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->business_type}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Main Markets</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->main_market}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Main Products</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->main_products}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Year Established</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->established_year}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. of Employees</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <profilesidebar style="padding-top: 8px;" >{{$company->total_employee}}</profilesidebar>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Capitalization</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->capitalization}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Annual Revenue</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->revenue}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Certifications</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->certifications}}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    @if($company->role == 'supplier' || $company->role == 'both')
                                    <li class="media">
                                        <div class="media-body">
                                            <ul class="sinlge-post-meta">
                                                <li><i class="fa fa-user"></i>Factory Information</li>

                                            </ul>
                                            <div class="form-horizontal">
                                                <div class="content">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Factory Location</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->factory_location}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Factory Size</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->factory_size}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. of Production Lines</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->production_lines}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Production Capacity</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->production_capacity}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Total Annual Purchase Volume</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->purchase_volume}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. of R&amp;D Staff</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->rd_stuff}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. of QC Staff</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->qc_stuff}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Quality Control</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;">{{$company->quality_control}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Contract Manufacturing</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->contract_manufact}}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-body">
                                            <ul class="sinlge-post-meta">
                                                <li><i class="fa fa-user"></i>Other Information</li>

                                            </ul>
                                            <div class="form-horizontal">
                                                <div class="content">
                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Registered Capital</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;">{{$company->capital}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Ownership Type</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;">{{$company->ownership}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Total Annual Sales Volume</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->sales_volume}}</p>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Export Percentage</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <p style="padding-top: 8px;" >{{$company->export_percent}}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    @endif
                                  </ul>
                            </div>

                            @if($company->role == 'supplier' || $company->role == 'both')
                            <div class="tab-pane fade" id="products" >
                              <h2 class="title text-center" style="margin-bottom: 15px;">Product List</h2>
                              @foreach($products as $product)
                                  <div class="col-sm-3">
                                      <div class="product-image-wrapper">
                                          <div class="single-products">
                                              <div class="productinfo text-center">
                                                  <a href="{{url('single-product',[$product->id])}}"><img src="{{first_image($product->images)}}" alt="" /></a>
                                                  <p><a href="{{url('single-product',[$product->id])}}"><strong>{{$product->name}}</strong></a></p>
                                                  <div class="product-grid-info">
                                                      <label for="">Model No.: </label> <span>{{$product->model_number}}</span> <br>
                                                      <label for="">Specification: </label> <span>{{$product->specification}}</span>
                                                  </div>

                                                  <a href="{{url('reqs/buyer-to-supplier',[$product->user])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Send Inquiry</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                            </div>
                            @endif

                            <div class="tab-pane fade" id="brochure" >
                              <h2 class="title text-center" style="margin-bottom: 15px;">Company Brochure</h2>
                              <div class="col-md-12" style="text-align: center;">
                                @if($company->brochure)
                                  <embed src="{{URL::asset($company->brochure)}}" width="100%" height="600" type='application/pdf'>
                                @endif
                              </div>
                            </div>

                        </div>

                    </div><!--/recommended_items-->

                </div>
            </div>


@endsection
