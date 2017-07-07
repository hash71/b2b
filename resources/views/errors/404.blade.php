@extends('publicview.master')

@section('title', 'Page Not Found')


@section('pagebody')

    <div class="row">
        <div class="content-404 text-center" style="margin-top: 50px; margin-bottom: 100px;">
            <img src="images/404/404.png" class="img-responsive" alt="" />
            <h1><b>OPPS!</b> We Couldn’t Find this Page</h1>
            <p>Uh... So it looks like you broke something. The page you are looking for has up and Vanished.</p>
            <h2><a href="{{url('/')}}">Bring me back Home</a></h2>
        </div>
    </div>

@endsection
