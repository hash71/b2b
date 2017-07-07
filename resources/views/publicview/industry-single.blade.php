@extends('publicview.master')

@section('title', 'industry List')

@section('pagebody')

        <div class="row">
            <div class="col-sm-12 single-element">
                <div class="blog-post-area">
                    <h2 class="title text-center">{!! $industry->title !!}</h2>
                    {!! $industry->post !!}
                    {{--<div class="single-blog-post">--}}
                        {{--<h3>Girls Pink T Shirt arrived in store</h3>--}}
                        {{--<div class="post-meta">--}}
                            {{--<ul>--}}
                                {{--<li><i class="fa fa-user"></i> Mac Doe</li>--}}
                                {{--<li><i class="fa fa-clock-o"></i> 1:33 pm</li>--}}
                                {{--<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<a class="featured-image" href="">--}}
                            {{--<img src="{{URL::asset('images/hero.jpg')}}" alt="">--}}
                        {{--</a>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>

@endsection