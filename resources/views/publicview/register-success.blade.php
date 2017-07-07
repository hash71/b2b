@extends('publicview.master')

@section('title', 'Login')


@section('pagebody')

            <div class="row" style="margin-top: 100px; margin-bottom: 140px;">

                <div class="col-sm-8 col-sm-offset-2 single-element">
                    <h3 class="bluetext text-center">Registration Successful</h3>

                    <div class="member-benefit col-sm-8 col-sm-offset-2 mrgT10" style="border: 1px solid #D2D2D2; margin-bottom: 20px;">
                        <h4 class="orangetext">Your registration is pending for approval. You will be notified on your Email after approval. Thanks.</h4>

                    </div>
                    <div class="col-sm-8 col-sm-offset-2" style="padding: 0px; margin-top: 5px">
                        <a href="{{url('/')}}" class="btn btn-default btn-default get wid100" style="margin: 0px; margin-bottom: 10px">Back to Home</a>
                    </div>

                </div>

              </div>


@endsection
