@extends('publicview.master')
<?php $title = $type.' List'; ?>
@section('title', $title)

@section('pagebody')

    <div class="row">
        <div class="col-sm-12 single-element">
            <div class="blog-post-area">
                <h2 class="title text-center">Latest From {{$type}}</h2>
                @foreach($posts as $post)
                    <div class="single-blog-post">
                        <h3><a href="{{url('post-show',$post->id)}}">{!! $post->title !!}</a></h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Admin</li>
                                <li><i class="fa fa-clock-o"></i> {{$post->created_at->format("h:i A")}}</li>
                                <li><i class="fa fa-calendar"></i> {{$post->created_at->toFormattedDateString()}}</li>
                            </ul>
                        </div>
                        @if($post->featured_image)
                        <a class="featured-image" href="">
                          <img src="{{URL::asset($post->featured_image)}}" alt="Image">
                        </a>
                        @endif

                        <p>{!! ttruncat($post->post, 300) !!}</p>
                        <a class="btn btn-primary" href="{{url('post-show',$post->id)}}">Read More</a>
                    </div>
                @endforeach
                <div class="text-right">
                  {!! $posts->render() !!}
                </div>


            </div>
        </div>
    </div>

@endsection
