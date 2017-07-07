@extends('publicview.master')
<?php $title = $post->type."-".$post->title; ?>
@section('title', $title)

@section('pagebody')

        <div class="row">
            <div class="col-sm-12 single-element">
                <div class="blog-post-area">
                    <h2 class="title text-center">{!! $post->title !!}</h2>
                    <div class="single-blog-post">

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
                        <p>
                          {!! $post->post !!}
                        </p>

                    </div>

                </div>
            </div>
        </div>

@endsection
