@extends('publicview.master')

@section('title', 'Post Buying Reqeust')

@section('custommetahead')
    <link href="{{ URL::asset('css/datepicker.css') }}" rel="stylesheet">
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
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <i class="fa fa-check sign"></i><strong>Success!</strong> {{session('success')}}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <i class="fa fa-time sign"></i><strong>Error!</strong> {{session('error')}}
</div>
@endif
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 single-element">

            <div class="signup-form"><!--sign up form-->
                <h2 style="color: #1C74B4; margin-bottom:30px;"><strong>Tell The Supplier What You Want</strong></h2>

                <form action="{{ URL::to('buying-request/new') }}" class="form-horizontal" role="form"
                      enctype="multipart/form-data" data-toggle="validator" method="post">

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" required class="form-control" placeholder="Product Name *"
                                   name="product_name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea class="form-control" required name="specification" id="spec" cols="30" rows="10"
                                      placeholder="Mention your Product Description-( Size\n- Grade/Quality Standard, Material, Color, Packing Instructions, Care / Wash Instructions)"></textarea>

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Attachment</label>
                        <div class="col-md-8">
                            <input type="file" name="images[]" multiple>

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group" id="main-category-list">
                        <label class="control-label col-md-2">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-8">
                            <select name="maincategory" id="maincategory" class="form-control col-md-5 col-xs-12">
                                <option value="0" selected="true" disabled="true">--- Select a Category ---</option>

                                @foreach($categories as $category)
                                    <option value="{{$category->parent}}">
                                        {{\App\Category::where('id',$category->parent)->value('name')}}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Sub Category<span class="required">*</span>
                        </label>
                        <div class="col-md-8">
                          <select name="category" id="sub_category" class="form-control col-md-5 col-xs-12">
                              <option value="0" selected="true" disabled="true">--- Select a Sub Category ---</option>

                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <input type="text" required class="form-control" placeholder="Estimated order quantity *"
                                   name="order_quantity">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-4">
                            <select name="quantity_unit" id="" class="form-control col-md-5 col-xs-12">
                                <option value="pieces">Pieces</option>
                                <option value="sets">Sets</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="text" class="form-control datepicker" placeholder="Expired Time"
                                   name="expire_date">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <!-- Captcha -->

                    @if(!Auth::check())
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <input required type="radio" class="flat" name="member" id="member" value="M"/> I am a
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
                        <button type="submit" class="btn btn-blue col-md-4 col-md-offset-4">Post Buying Request</button>
                    </div>
                </form>
            </div><!--/sign up form-->

        </div>
    </div>

@endsection

@section('customscripts')
    <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
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
            /* DatePicker */
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            $options = "";

            @foreach($cats as $category)
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

            var cat_sub_cat = {!!json_encode($categories)!!};

            $(document).on('change','#maincategory',function(){
                $elem = $(this).val();
                $('#sub_category').find('option:gt(0)').remove();

                for(var i = 0;i<cat_sub_cat.length;i++)
                {
                    if(cat_sub_cat[i].parent==$elem)
                    {
                        for(var key in cat_sub_cat[i].child)
                        {
                            var data = cat_sub_cat[i].child[key];
                            $('#sub_category').append('<option value="'+key+'">'+data+'</option>');
                        }
                    }
                }
            });
        });
    </script>
@endsection
