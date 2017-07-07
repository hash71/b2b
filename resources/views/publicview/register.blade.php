@extends('publicview.master')

@section('title', 'Registration')

<script src='https://www.google.com/recaptcha/api.js'></script>
@section('pagebody')


    <div class="row">
        <div class="col-sm-8 single-element">

            <div class="signup-form"><!--sign up form-->
                <h2 class="text-center" style="color: #1C74B4; margin-bottom:30px;"><strong>Your Business starts here</strong>
                    <small>It's easy and simple, takes just minutes</small>
                </h2>

                @if(session('error'))
                    <div class="alert alert-danger col-sm-10 col-sm-offset-1">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-time sign"></i><strong>Error!</strong> {{session('error')}}
                    </div>
                @endif

                <div class="col-sm-10 col-sm-offset-1 sign-up-form">
                    <form action="{{ URL::to('auth/register') }}" class="form-horizontal" role="form"
                      data-toggle="validator" method="post">

                    <h4>Create Account</h4>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Email Address*</label>
                        <div class="col-md-9">
                            <input type="email" required class="form-control" placeholder="Email Address *"
                                   name="email">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Password*</label>
                        <div class="col-md-9">
                            <input type="password" required class="form-control" id="password" placeholder="Password *"
                                   name="password">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Repeat Password*</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" id="inputPasswordConfirm" name="passwordConfirm"
                                   data-match="#password" data-match-error="Password didn't match"
                                   placeholder="Repeat password *" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <h4>Enter Your Business Information</h4>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Country* </label>
                        <div class="col-md-8">
                            <?php $countries = country_list(); asort($countries);?>
                            <select name="country" id="" class="form-control col-md-5 col-xs-12">
                                <option value="0" selected="true" disabled="true">--- Select a Country ---</option>
                                @foreach($countries as $key => $country)
                                <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">I am a* </label>
                        <div class="col-md-9 radio-group">
                            <label class="radio-inline col-md-3"><input type="radio" checked="checked" name="role"  value="buyer">Buyer</label>
                            <label class="radio-inline col-md-3"><input type="radio" name="role" value="supplier">Supplier</label>
                            <label class="radio-inline col-md-3"><input type="radio" name="role" value="both">Both</label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Company Name* </label>
                        <div class="col-md-9">
                            <input type="text" required class="form-control" placeholder="Company Name *"
                                   name="company_name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Industry* </label>
                        <div class="col-md-8">
                            <select required name="category" id="" class="form-control col-md-5 col-xs-12">
                                <option value="0" selected="true" disabled="true">--- Select a Industry ---</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Contact Person* </label>
                        <div class="col-md-9">
                            <input type="text" required class="form-control" placeholder="Contact Person *"
                                   name="contact_person">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                         <label class="col-md-3 control-label">Business Phone* </label>
                        <div class="col-md-9">
                            <input type="text" required class="form-control" placeholder="Business Phone *"
                                   name="business_phone">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <!-- Captcha -->


                    <div class="form-group">
                        <div class="checkbox col-md-10 col-md-offset-2">
                            <label><input type="checkbox" required value="">I agree with the SourcingKey.com <a href="">Terms
                                    and services</a>
                                <div style="text-align: left;" class="help-block with-errors"></div>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox col-md-10 col-md-offset-2">
                            <label><input type="checkbox" name="subscribe" value="1">I would like to recieve information
                                related to my industry and service notification letters from Sourcingkey.com</label>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <div class="checkbox col-md-6 col-md-offset-3 text-center">
                            {!! app('captcha')->display() !!}
                        </div>
                    </div> -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue col-md-4 col-md-offset-4">Create my Account</button>
                    </div>
                </form>
                </div>


            </div><!--/sign up form-->
        </div>

        <div class="member-benefit col-sm-3 col-sm-offset-1 single-element">
            <h4 class="orangetext">Member Benefits</h4>
            <p><strong>Promote your products around the world</strong></p>
            <div class="benefits">
                <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i>
                <p style="padding-left: 0px;" class="col-sm-11">Get your own website for free</p>
                <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i>
                <p style="padding-left: 0px;" class="col-sm-11">Get 'Buyers' &amp; 'Suppliers' inquiries from all over
                    the world</p>
                <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i>
                <p style="padding-left: 0px;" class="col-sm-11">Communicate with trade partners in real-time</p>
                <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i>
                <p style="padding-left: 0px;" class="col-sm-11">Stay tuned with email update</p>
            </div>


            <a class="pull-right" href="#">more info <i class="fa fa-angle-right"></i></a>
        </div>
    </div>

@endsection
