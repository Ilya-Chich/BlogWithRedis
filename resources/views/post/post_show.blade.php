@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/index.css') }}">
@endsection
@section('content')
    @if($post)
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $post->title }}</h2>
                <p class="blog-post-meta">
                    <small><i>{{ $post->created_at }} by <a href="#">test</a></i></small>
                </p>
                <blockquote class="text-break">
                    <p class="blog-post-meta">{{ $post->description }}</p>
                </blockquote>
            </div>
        </div>
    @else
        <p class="text-center text-primary">No Posts created Yet!</p>
    @endif
@endsection