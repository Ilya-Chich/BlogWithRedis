@extends('layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ URL::to('css/index.css') }}">
@endsection
@section('title')
    Blog
@endsection

@section('content')
    <main role="main" class="container" style="margin-top: 5px">

        <div class="row">

            <div class="col-sm-8 blog-main">
                @if($dataset['posts'])
                    @foreach($dataset['posts'] as $post)
                        <div class="blog-post rounded">
                            <h2 class="blog-post-title">{{ $post->title }}</h2>
                            <p class="blog-post-meta">
                                <small><i>{{ $post->created_at }} by <a href="#">{{ $post->name }}</a></i></small>
                            </p>
                            <blockquote class="text-break">
                                <p class="blog-post-meta">{{ $post->postPreview }}</p>
                            </blockquote>
                            @if($post->lengthOfPost >= 500)
                                <div class="text-center">
                                    <a href="{{ URL::to('post/' . $post->id) }}"
                                       class="btn btn-primary btn-sm">TL;DR</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-primary">No Posts created Yet!</p>
                @endif


            </div><!-- /.blog-main -->

            <aside class="col-sm-3 ml-sm-auto blog-sidebar">
                <div class="sidebar-module rounded">
                    <h4>Latest Posts</h4>
                    <ol class="list-unstyled">
                        @if($dataset['dateTimeOfPosts'])
                            @foreach($dataset['dateTimeOfPosts'] as $dateTimeOfPost)
                                <li>
                                    <a href="#">{{ Carbon\Carbon::parse($dateTimeOfPost->created_at)->format('jS F Y') }}</a>
                                </li>
                            @endforeach
                        @else
                            <p class="text-center text-primary">No Posts created Yet!</p>
                        @endif
                    </ol>
                </div>
                <div class="sidebar-module rounded">
                    <h4>Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>
            </aside><!-- /.blog-sidebar -->
            <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"
               title="Click to return on the top page" data-toggle="tooltip" data-placement="top">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
        </div><!-- /.row -->

    </main><!-- /.container -->
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ URL::to('js/async.js') }}"></script>
@endsection