@extends('userview.master')

@section('title', 'Dashboard')




@section('pagebody')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    <h2>Dashboard content
                        <small>small description</small>
                    </h2>
                    @if(session('error'))
                        <div class="alert alert-danger" style="margin-top: 60px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="fa fa-warning sign"></i><strong>Error!</strong> {{session('error')}}
                        </div>
                    @endif

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <div class="row" style="height: 400px;">

                        </div>

                    </div>
                </div>
            </div>


        </div>

    </div>


@endsection