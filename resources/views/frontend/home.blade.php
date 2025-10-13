@extends('layouts.frontend.app')

@section('title')
    Home
@endsection

@section('content')

    @php
        $latestPosts = $posts->take(3);
        $fourthPosts = $posts->take(4);
    @endphp

            <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach($latestPosts as $latestPost_top )

                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ $latestPost_top->images->first()->path }}"
                                         alt="{{ $latestPost_top->title }}"/>
                                    <div class="tn-title">
                                        <a href="{{ route('front.post.single-post' , $latestPost_top->slug )  }} "
                                           title="{{ $latestPost_top->title }}">{{$latestPost_top->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    <div class="row">
                        @foreach($fourthPosts as $fourthPost )
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ $fourthPost->images->first()->path }}" alt="{{ $fourthPost->title }}"/>
                                    <div class="tn-title">
                                        <a href="{{ route('front.post.single-post' , $fourthPost->slug) }}"
                                           title="{{ $fourthPost->tilte }}">{{ $fourthPost->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                @foreach($categories_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">
                            @foreach($category->posts as $category_post)
                                <div class="col-md-6">
                                    <div class="cn-img">
                                        <img src="{{ $category_post->images->first()->path }}"
                                             alt="{{$category_post}}"/>
                                        <div class="cn-title">
                                            <a href="{{ route('front.post.single-post' , $category_post->slug) }}"
                                               title="{{ $category_post->title }}">{{ $category_post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category News End-->



    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#popular"
                            >Popular News</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#Oldest"
                            >Oldest News</a
                            >
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="popular" class="container tab-pane active">
                            @foreach($greatest_posts_comments as $greatest_post_comment)

                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $greatest_post_comment->images->first()->path }}"
                                             alt="{{ $greatest_post_comment->title }}"/>
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('front.post.single-post' , $greatest_post_comment->slug) }}"
                                           title="{{ $greatest_post_comment->title }}">{{ $greatest_post_comment->title }}
                                            .comment ({{ $greatest_post_comment->comments_count }})</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="Oldest" class="container tab-pane fade">
                            @foreach($oldest_posts as $oldest_post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $oldest_post->images->first()->path }}"
                                             alt="{{ $oldest_post->title }}">
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('front.post.single-post' , $oldest_post->slug) }}"
                                           title="{{ $oldest_post->title }}">{{ $oldest_post->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#latest-viewed"
                            >Latest Viewed</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read"
                            >Most Read</a
                            >
                        </li>

                    </ul>


                    <div class="tab-content">
                        <div id="latest-viewed" class="container tab-pane active">
                            @foreach($latestPosts as $lastPost)

                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $lastPost->images->first()->path }}" alt="{{ $lastPost->title }}">
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('front.post.single-post' , $lastPost->slug) }}"
                                           title="{{ $lastPost->title }}">{{ $lastPost->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div id="m-read" class="container tab-pane fade">
                            @foreach($greatest_posts_view as $greatest_post)

                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $greatest_post->images->first()->path }}"
                                             alt="{{ $greatest_post->title }}">
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{ route('front.post.single-post' , $greatest_post->slug) }}"
                                           title="{{ $greatest_post->title }}">{{ $greatest_post->title }}
                                            .({{ $greatest_post->num_of_views }})</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->path }}" alt="{{ $post->title }}">
                                    <div class="mn-title">
                                        <a href="{{ route('front.post.single-post' , $post->slug) }}"
                                           title="{{ $post->title }}">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    {{$posts->links()}}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach($read_more_posts as $read_more_post)

                                <li><a href="{{ route('front.post.single-post' , $read_more_post->slug) }}"
                                       title="{{ $read_more_post->title }}">{{ $read_more_post->title }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->

@endsection