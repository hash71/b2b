@extends('publicview.master')

@section('title', 'Send Inquiry')

@section('custommetahead')
    <link href="{{ URL::asset('css/icheck/flat/green.css') }}" rel="stylesheet">
    <style>
        .accountinfo {
            border: 1px solid #999;
            margin-bottom: 10px;
        }
    </style>
@endsection

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
        <div class="col-sm-8 col-sm-offset-2 single-element">

            <div class="signup-form"><!--sign up form-->
                <h2 style="color: #1C74B4; margin-bottom:30px;"><strong>Contact Suppliers</strong></h2>

                <form action="{{ url('reqs/buyer-to-supplier',[$supplier_id]) }}" class="form-horizontal" role="form"
                      enctype="multipart/form-data" data-toggle="validator" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="required">*</span>To:
                        </label>
                        <div class="col-md-8">
                            <label class="control-label">{{\App\User::where('id',$supplier_id)->value('company_name')}}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="required">*</span>Subject:
                        </label>
                        <div class="col-md-8">
                            <input type="text" required class="form-control" placeholder="(5-50 characters)"
                                   name="subject">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="required">*</span>Message:
                        </label>
                        <div class="col-md-8">
                            <textarea class="form-control" required name="message" id="" cols="30" rows="10"
                                      placeholder="(20-4000 characters)"></textarea>

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <a id="additional_req" class="col-md-4 col-md-offset-2" href="#"><i class="fa fa-plus"></i>Additional
                            Requests</a>
                    </div>

                    <div class="form-group" id="req_div" style="display: none;">
                        <label class="control-label col-md-2">Please send me:
                        </label>
                        <div class="col-md-4">
                            <input type="checkbox" name="additional[]" id="additional1" value="min_order_quantity"
                                   class="flat"/> Minimum Order Quantity <br>
                            <input type="checkbox" name="additional[]" id="additional2" value="specification"
                                   class="flat"/> Product Specification <br>
                            <input type="checkbox" name="additional[]" id="additional3" value="packing_details"
                                   class="flat"/> Packing Details <br>
                            <input type="checkbox" name="additional[]" id="additional3" value="origin_country"
                                   class="flat"/> Country of Origin
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" name="additional[]" id="additional1" value="payment_terms"
                                   class="flat"/> Payment Terms <br>
                            <input type="checkbox" name="additional[]" id="additional2" value="sample_availability"
                                   class="flat"/> Sample Availability/Cost <br>
                            <input type="checkbox" name="additional[]" id="additional3" value="inspection_certificate"
                                   class="flat"/> Inspection Certificate <br>
                            <input type="checkbox" name="additional[]" id="additional3" value="delivery_lead_time"
                                   class="flat"/> Delivery Lead Time
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="required">*</span>Reply within:
                        </label>
                        <div class="col-md-8">
                            <label class="control-label col-md-6">Please reply to my inquiry within </label>
                            <select class=" col-md-6" name="response_required_time" id="">
                                <option value="1">1 day</option>
                                <option value="2">2 days</option>
                                <option value="3">3 days</option>
                                <option value="4">4 days</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Product Photo</label>
                        <div class="col-md-8">
                            <input type="file" name="images[]" multiple>

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <!-- Captcha -->

                    @if(!Auth::check())
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <input type="radio" class="flat" name="member" id="member" value="M"/> I am a
                                member <br>
                                <input type="radio" class="flat" name="member" id="notmember" value="NM"/> I am not a
                                member
                            </div>
                        </div>
                    @endif


                                <!-- Sign IN Form -->
                        <div id="signin" class="accountinfo col-md-8 col-md-offset-2">

                        </div>


                        <!-- Sign Up Form -->
                        <div id="signup" class="accountinfo col-md-8 col-md-offset-2">

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-blue col-md-4 col-md-offset-4">Send</button>
                        </div>
                </form>
            </div><!--/sign up form-->

        </div>
    </div>

@endsection

@section('customscripts')
    <script src="{{URL::asset('js/icheck.min.js') }}"></script>

    <script>
        jQuery(document).ready(function ($) {
            $('#member').removeAttr('checked');
            $('#notmember').removeAttr('checked');
            $('#signin').hide();
            $('#signup').hide();

            if ($("input.flat")[0]) {
                $('input.flat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            }

            $(document).on('click', '#additional_req', function (e) {
                e.preventDefault();
                $('#req_div').toggle('slow');
                return false;
            });


            $options = "";

            @foreach($categories as $category)
                    $options += '<option value="{{$category->id}}">{{$category->name}}</option>';
            @endforeach
            $signinfields = '<h2 style="color: #1C74B4; margin-bottom:30px; text-align: center"><strong>Enter Account Information</strong></h2> <div class="form-group"><label for="email" class="col-md-2 control-label">Email</label><div class="col-md-10"><input type="email" required class="form-control" placeholder="Email Address *" name="email"> <div class="help-block with-errors"></div></div></div><div class="form-group"><label for="password" class="col-md-2 control-label">Password</label><div class="col-md-10"><input type="password" required class="form-control" id="password" placeholder="Password *" name="login_password"></div></div>';

            $captcha = '<script src="https://www.google.com/recaptcha/api.js" async defer><\/script><div class="g-recaptcha" data-sitekey="6Lf3SxQTAAAAAOKcaWDImS7_jsTND7UVToDWx4zB"></div>';

            <?php $countries = country_list(); asort($countries);?>



            $country = '<div class="form-group"><label class="col-md-2 control-label">Country</label><div class="col-md-8"><select name="country" id="" class="form-control col-md-5 col-xs-12"><option value="0" selected="true" disabled="true">--- Select a Country ---</option>';

            @foreach($countries as $key => $country)
            $country += '<option value="{{$country}}">{{$country}}</option>';
            @endforeach

            $country += '</select><div class="help-block with-errors"></div></div></div>';

            $signupfields = '<h2 style="color: #1C74B4; margin-bottom:30px; text-align: center"><strong>Enter Account Information</strong></h2><div class="form-group"><label for="email" class="col-md-2 control-label">Email Address</label><div class="col-md-10"><input type="email" required class="form-control" placeholder="Email Address *" name="email"><div class="help-block with-errors"></div></div></div><div class="form-group"><label for="password" class="col-md-2 control-label">Password</label><div class="col-md-10"><input type="password" required class="form-control" id="password" placeholder="Password *" name="reg_password"><div class="help-block with-errors"></div></div></div><div class="form-group"><label for="password" class="col-md-2 control-label">Password</label><div class="col-md-10"><input type="password" class="form-control" id="inputPasswordConfirm" name="passwordConfirm" data-match="#password" data-match-error="Password didn\'t match" placeholder="Repeat password *" required> <div class="help-block with-errors"></div> </div></div> '+$country+' <div class="form-group"> <label for="password" class="col-md-2 control-label">I am a</label> <div class="col-md-10 radio-group"> <label class="radio-inline col-md-3"><input type="radio" checked="checked" name="type" value="buyer">Buyer</label> <label class="radio-inline col-md-3"><input type="radio" name="type" value="supplier">Supplier</label> <label class="radio-inline col-md-3"><input type="radio" name="type" value="both">Both</label> <div class="help-block with-errors"></div> </div> </div> <div class="form-group"> <label for="email" class="col-md-2 control-label">Company Name</label> <div class="col-md-10"> <input type="text" required class="form-control" placeholder="Company Name *" name="company_name"> <div class="help-block with-errors"></div> </div> </div> <div class="form-group"> <label for="email" class="col-md-2 control-label">Industry</label> <div class="col-md-8"> <select name="category" id="" class="form-control col-md-5 col-xs-12"> <option value="0" selected="true" disabled="true">--- Select a Industry ---</option> ' + $options + '</select><div class="help-block with-errors"></div></div></div><div class="form-group"><label for="email" class="col-md-2 control-label">Contact Person</label><div class="col-md-10"><input type="text" required class="form-control" placeholder="Contact Person *" name="contact_person"> <div class="help-block with-errors"></div> </div> </div> <div class="form-group"> <label for="email" class="col-md-2 control-label">Business Phone</label> <div class="col-md-10"> <input type="text" required class="form-control" placeholder="Business Phone *" name="business_phone"> <div class="help-block with-errors"></div> </div> </div> <!-- Captcha --> <div class="form-group"> <div class="checkbox col-md-10 col-md-offset-2"> <label><input type="checkbox" required value="">I agree with the SourcingKey.com <a href="">Terms and services</a> <div style="text-align: left;" class="help-block with-errors"></div> </label> </div> </div> <div class="form-group"> <div class="checkbox col-md-10 col-md-offset-2"> <label><input type="checkbox" name="subscribe" value="1">I would like to recieve information related to my industry and service notification letters from Sourcingkey.com</label> </div> </div><div class="form-group"><div class="checkbox col-md-6 col-md-offset-2 text-center">'+$captcha+'</div></div>';

            $(document).on('ifChecked', '#member', function () {
                $('#signin').html($signinfields);
                $('#signin').slideDown("slow");
                $('#signup').hide();
                $('#signup').html('');
            });

            $(document).on('ifChecked', '#notmember', function () {
                $('#signup').html($signupfields);
                $('#signup').slideDown("slow");
                $('#signin').hide();
                $('#signin').html('');
            });
        });

    </script>
@endsection
