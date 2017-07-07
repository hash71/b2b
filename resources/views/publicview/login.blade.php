@extends('publicview.master')

@section('title', 'Login')


@section('pagebody')

            <div class="row" style="margin-top: 40px; margin-bottom: 40px;">

                <div class="col-sm-6  single-element">
                    <h3 class="bluetext text-center">Not a Sourcingkey Member Yet?</h3>
                    <h2 class="orangetext text-center">Join Now to Get Started</h2>

                    <div class="member-benefit col-sm-8 col-sm-offset-2 mrgT10" style="border: 1px solid #999;">
                        <h4 class="orangetext">Member Benefits</h4>
                        <p><strong>Promote your products around the world</strong></p>
                        <div class="benefits">
                            <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i><p style="padding-left: 0px;" class="col-sm-11">Get your own website for free</p>
                            <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i><p style="padding-left: 0px;" class="col-sm-11">Get 'Buyers' &amp; 'Suppliers' inquiries from all over the world</p>
                            <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i><p style="padding-left: 0px;" class="col-sm-11">Communicate with trade partners in real-time</p>
                            <i style="padding-left: 0px;" class="fa fa-check col-sm-1"></i><p style="padding-left: 0px;" class="col-sm-11">Stay tuned with email update</p>
                        </div>

                        <a class="pull-right" href="{{url('/')}}">more info <i class="fa fa-angle-right"></i></a>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2" style="padding: 0px; margin-top: 5px">
                        <a href="{{url('auth/register')}}" class="btn btn-default orangecolor get wid100" style="margin: 0px; margin-bottom: 10px">Join Now</a>
                    </div>

                </div>


                <div class="col-sm-5 col-sm-offset-1 single-element">
                    <div class="signup-form"><!--sign up form-->
                        <h2 style="color: #1C74B4; margin-bottom:30px; text-align: center"><strong>Sign in to your account</strong></h2>

                          @if (count($errors) > 0)
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                            </div>
                          @endif


                        <form action="{{ URL::to('auth/login') }}" class="form-horizontal" role="form" data-toggle="validator" method="post">

                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">Email</label>
                            <div class="col-md-10">
                                <input type="email" required class="form-control" placeholder="Email Address *" name="email">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">Password</label>
                            <div class="col-md-10">
                                <input type="password" required class="form-control" id="password" placeholder="Password *" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox col-md-10 col-md-offset-1">
                              <label><input type="checkbox" name="remember">Remember Me </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-blue col-md-4 col-md-offset-4">Log In</button>
                        </div>
                        </form>
                        <div class="text-center">
                            <a href="">Forget Password?</a> | <a href="">Problem Signing In?</a>
                            <hr>
                            <p>New to SourcingKey.com? <a href="{{url('auth/register')}}">Join Free</a></p>
                        </div>
                    </div><!--/sign up form-->

                </div>
            </div>


@endsection
