@extends('publicview.master')

@section('title', 'Industry List')

@section('pagebody')

    <div class="row">
        <div class="col-sm-12 single-element">
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From Industry</h2>
                @foreach($industry_list as $industry)
                    <div class="single-blog-post">
                        <h3>{!! $industry->title !!}</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Mac Doe</li>
                                <li><i class="fa fa-clock-o"></i> {{$industry->created_at->format("h:i A")}}</li>
                                <li><i class="fa fa-calendar"></i> {{$industry->created_at->toFormattedDateString()}}
                                </li>
                            </ul>
                        </div>
                        {{--<a class="featured-image" href="">--}}
                        {{--<img src="{{URL::asset('images/hero.jpg')}}" alt="">--}}
                        {{--</a>--}}

                        <p>{!! ttruncat($industry->post, 300) !!}</p>
                        <a class="btn btn-primary" href="{{url('post/industry-show/'.$industry->id)}}">Read More</a>
                    </div>
                @endforeach

                {!! $industry_list->render() !!}

            </div>
        </div>
    </div>

@endsection