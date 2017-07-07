@extends('publicview.master')

@section('title', 'Buyer Contact Form')

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

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 single-element">

            <div class="signup-form">
                <h2 style="color: #1C74B4; margin-bottom:30px;"><strong>Quick Contact With Buyers in second</strong>
                </h2>

                <form action="{{ url('reqs/supplier-to-buyer',[$buyer_id]) }}" class="form-horizontal" role="form"
                      enctype="multipart/form-data" data-toggle="validator" method="post">

                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="required">*</span>To:
                        </label>
                        <div class="col-md-8">
                            <label class="control-label">{{\App\User::where('id',$buyer_id)->value('company_name')}}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2"><span class="required">*</span>For:
                        </label>
                        <div class="col-md-8">
                            <label class="control-label">{{\App\BuyProduct::where('id',$product_id)->value('product_name')}}</label>
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
                        <label class="control-label col-md-2">I want to know:
                        </label>
                        <div class="col-md-3 contactform-check" style="padding-left: 15px;">
                            <input type="checkbox" name="additional[]" id="additional1" value="min_order_quantity"
                                   class="flat"/> Quantity required

                        </div>
                        <div class="col-md-3 contactform-check">
                            <input type="checkbox" name="additional[]" id="additional2" value="specification"
                                   class="flat"/> Annual purchase volume

                        </div>
                        <div class="col-md-3 contactform-check">
                            <input type="checkbox" name="additional[]" id="additional2" value="specification"
                                   class="flat"/> Payment preferences

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Supplying Ability:
                        </label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder=""
                                   name="supply_ability">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Attachments: </label>
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

            $signupfields = '<h2 style="color: #1C74B4; margin-bottom:30px; text-align: center"><strong>Enter Account Information</strong></h2><div class="form-group"><label for="email" class="col-md-2 control-label">Email Address</label><div class="col-md-10"><input type="email" required class="form-control" placeholder="Email Address *" name="email"><div class="help-block with-errors"></div></div></div><div class="form-group"><label for="password" class="col-md-2 control-label">Password</label><div class="col-md-10"><input type="password" required class="form-control" id="password" placeholder="Password *" name="reg_password"><div class="help-block with-errors"></div></div></div><div class="form-group"><label for="password" class="col-md-2 control-label">Password</label><div class="col-md-10"><input type="password" class="form-control" id="inputPasswordConfirm" name="passwordConfirm" data-match="#password" data-match-error="Password didn\'t match" placeholder="Repeat password *" required> <div class="help-block with-errors"></div> </div></div> ' + $country + ' <div class="form-group"> <label for="password" class="col-md-2 control-label">I am a</label> <div class="col-md-10 radio-group"> <label class="radio-inline col-md-3"><input type="radio" checked="checked" name="type" value="buyer">Buyer</label> <label class="radio-inline col-md-3"><input type="radio" name="type" value="supplier">Supplier</label> <label class="radio-inline col-md-3"><input type="radio" name="type" value="both">Both</label> <div class="help-block with-errors"></div> </div> </div> <div class="form-group"> <label for="email" class="col-md-2 control-label">Company Name</label> <div class="col-md-10"> <input type="text" required class="form-control" placeholder="Company Name *" name="company_name"> <div class="help-block with-errors"></div> </div> </div> <div class="form-group"> <label for="email" class="col-md-2 control-label">Industry</label> <div class="col-md-8"> <select name="category" id="" class="form-control col-md-5 col-xs-12"> <option value="0" selected="true" disabled="true">--- Select a Industry ---</option> ' + $options + '</select><div class="help-block with-errors"></div></div></div><div class="form-group"><label for="email" class="col-md-2 control-label">Contact Person</label><div class="col-md-10"><input type="text" required class="form-control" placeholder="Contact Person *" name="contact_person"> <div class="help-block with-errors"></div> </div> </div> <div class="form-group"> <label for="email" class="col-md-2 control-label">Business Phone</label> <div class="col-md-10"> <input type="text" required class="form-control" placeholder="Business Phone *" name="business_phone"> <div class="help-block with-errors"></div> </div> </div> <!-- Captcha --> <div class="form-group"> <div class="checkbox col-md-10 col-md-offset-2"> <label><input type="checkbox" required value="">I agree with the SourcingKey.com <a href="">Terms and services</a> <div style="text-align: left;" class="help-block with-errors"></div> </label> </div> </div> <div class="form-group"> <div class="checkbox col-md-10 col-md-offset-2"> <label><input type="checkbox" name="subscribe" value="1">I would like to recieve information related to my industry and service notification letters from Sourcingkey.com</label> </div> </div><div class="form-group"><div class="checkbox col-md-6 col-md-offset-2 text-center">' + $captcha + '</div></div>';

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
