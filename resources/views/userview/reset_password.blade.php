@extends('userview.master')

@section('title', 'Reset Password')


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
            <i class="fa fa-warning sign"></i><strong>Error!</strong> {{session('error')}}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <br/>
                    <form action="{{url('profile/reset-password')}}" method="POST"
                          class="form-horizontal form-label-left" data-toggle="validator" enctype="multipart/form-data">
                        <h4 class="form-title">Change Password</h4>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Old Password
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" name="old" class="form-control col-md-7 col-xs-12" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="password" name="new" class="form-control col-md-7 col-xs-12" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm New Password
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="inputPasswordConfirm" data-match="#password" data-match-error="Password didn't match" name="confirm" class="form-control col-md-7 col-xs-12" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-5">
                                <button type="submit" class="btn btn-success">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('customfooterscript')
<script src="{{URL::asset('js/validator.min.js') }}"></script>

@endsection
