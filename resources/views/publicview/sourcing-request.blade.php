@extends('publicview.master')

@section('title', 'Sourcing Reqeust')

@section('custommetahead')
    <link href="{{ URL::asset('css/icheck/flat/green.css') }}" rel="stylesheet">
@endsection

@section('pagebody')

@if(session('success'))
    <div class="alert alert-success" style="margin-top: 60px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-check sign"></i><strong>Success!</strong> {{session('success')}}
    </div>
@endif

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 single-element">

            <div class="signup-form"><!--sign up form-->
                <h2 style="color: #1C74B4; margin-bottom:30px;"><strong>Please tell us what you want, fill in the following form</strong></h2>

                <form action="{{ URL::to('sourcing-request') }}" class="form-horizontal" role="form"
                      enctype="multipart/form-data" data-toggle="validator" method="post">

                    <div class="form-group">
                        <label class="col-md-2 control-label">*Inquiry</label>
                        <div class="col-md-8">
                            <textarea class="form-control" required name="inquiry" id="" cols="30" rows="10"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">*Country</label>
                        <div class="col-md-8">
                          <?php $countries = country_list(); asort($countries);?>
                          <select name="country" required id="" class="form-control col-md-5 col-xs-12">
                              <option value="0" selected="true" disabled="true">--- Select a Country ---</option>
                              @foreach($countries as $key => $country)
                              <option value="{{$country}}">{{$country}}</option>
                              @endforeach
                          </select>
                          <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">*Company Name</label>
                        <div class="col-md-8">
                            <input type="text" required class="form-control" placeholder="Company Name *"
                                   name="company_name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">*Your Name</label>
                        <div class="col-md-8">
                            <input type="text" required class="form-control" placeholder="Your Name *"
                                   name="sender_name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">*Telephone</label>
                        <div class="col-md-8">
                            <input type="text" required class="form-control" placeholder="Telephone *"
                                   name="telephone">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">*Email</label>
                        <div class="col-md-8">
                            <input type="text" required class="form-control" placeholder="Email *"
                                   name="email">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">*You are:
                        </label>
                        <div class="col-md-2 contactform-check" style="padding-left: 15px;">
                            <input type="radio" name="user_type" value="supplier"
                                   class="flat"/> Supplier
                        </div>
                        <div class="col-md-2 contactform-check" style="padding-left: 15px;">
                            <input type="radio" name="user_type" value="buyer"
                                   class="flat"/> Buyer
                        </div>
                        <div class="col-md-2 contactform-check" style="padding-left: 15px;">
                            <input type="radio" name="user_type" value="both"
                                   class="flat"/> Both
                        </div>
                        <div class="col-md-2 contactform-check" style="padding-left: 15px;">
                            <input type="radio" name="user_type" value="visitor"
                                   class="flat"/> Visitor
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Mobile</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Mobile"
                                   name="mobile">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-blue col-md-4 col-md-offset-4">Submit</button>
                    </div>
                </form>
            </div><!--/sign up form-->

        </div>
    </div>

@endsection

@section('customscripts')
<script src="{{URL::asset('js/icheck.min.js') }}"></script>
<script>
    jQuery(document).ready(function($) {
        if ($("input.flat")[0]) {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        }
    });
</script>
@endsection
