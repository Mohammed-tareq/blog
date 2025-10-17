@extends('layouts.frontend.app')
@section('tags')
    {{ $post->tags }}
@endsection
@section('description')
    {{ $post->small_desc }}
@endsection

@section('title')
    Single Post {{$post->title}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{$post->title}}</li>
@endsection

@section('content')

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($post->images as $count_of_silde)
                                <li data-target="#newsCarousel"
                                    data-slide-to="{{$loop->index == 0? 'active' : ''}}">{{$loop->index}}</li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($post->images as $post_image )

                                <div class="carousel-item {{$loop->index == 0 ? 'active': ''}}">
                                    <img src="{{ asset($post_image->path) }}" class="d-block w-100" alt="First Slide">

                                </div>
                            @endforeach

                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content ">
                        <h1 class="sn-title">{{ $post->title }}</h1>
                        <div class="sn-meta mb-4">
                            <span class="m-1"><i class="fa fa-user"></i> {{ $post->user->name }}</span>
                            <span class="m-1"><i
                                        class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
                            <span class="m-1"><i class="fa fa-tags"></i> {{ $post->category->name }}</span>
                        </div>
                        {!! chunk_split($post->description, 40) !!}
                    </div>

                    @if(!empty($post->comment_able))
                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <form id="commentForm">
                            @csrf
                            <div class="comment-input">
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <input type="text" name="comment" placeholder="Add a comment..." id="commentBox"/>
                                <button>Comment</button>
                            </div>
                        </form>
                        <div class="alert alert-danger" style="display: none;" id="commentError">

                        </div>

                        <!-- Display Comments -->
                        <div class="comments" id="comments">
                            @foreach($post->comments as $post_comment)

                                <div class="comment">
                                    <img src="{{asset($post_comment->user->image)}}" alt="{{$post_comment->user->name}}"
                                         class="comment-img"/>
                                    <div class="comment-content">
                                        <span class="username">{{$post_comment->user->name}}</span>
                                        <p class="comment-text">{{ $post_comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Add more comments here for demonstration -->
                        </div>
                        @if($post->comments()->count() > 2)
                            <!-- Show More Button -->
                            <button id="showMoreBtn" class="show-more-btn">Show more</button>
                        @endif
                    </div>
                    @endif

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider ">
                            @foreach($category_with_posts as $category_post_related)

                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ asset($category_post_related->images->first()->path) }}"
                                             class="img-fluid"
                                             alt="{{ $category_post_related->title }}"/>
                                        <div class="sn-title">
                                            <a href="{{route('front.post.single-post', $category_post_related->slug)}}"
                                               title="{{ $category_post_related->title }}">{{ $category_post_related->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach($category_with_posts as $category_post)

                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ asset($category_post->images->first()->path) }}"/>
                                        </div>
                                        <div class="nl-title">
                                            <a href="{{route('front.post.single-post', $category_post->slug)}}"
                                               title="{{ $category_post->title }}"
                                            >{{$category_post->title}}</a
                                            >
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>


                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#popular"
                                        >Popular</a
                                        >
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest"
                                        >Latest</a
                                        >
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="popular" class="container tab-pane active">
                                        @foreach($greatest_posts_comments as $greatest_post_comment)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($greatest_post_comment->images->first()->path) }}"
                                                         class="img-fluid" alt="{{ $greatest_post_comment->title }}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{route('front.post.single-post', $greatest_post_comment->slug)}}"
                                                       title="{{ $greatest_post_comment->title }}">{{ $greatest_post_comment->title }}
                                                        .
                                                        comment({{$greatest_post_comment->comments_count}})</a
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="latest" class="container tab-pane fade">
                                        @foreach($latest_posts as $latest_post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($latest_post->images->first()->path) }}"
                                                         alt="{{ $latest_post->title }}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{route('front.post.single-post', $latest_post->slug)}}"
                                                       title="{{ $latest_post->title }}">{{ $latest_post->title }}</a
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @php
                                        $category_share = $categories_share->take(5);
                                    @endphp
                                    @foreach($category_share as $category)
                                        <li>
                                            <a href="{{ route('front.category' , $category->slug) }}"
                                               title="{{ $category->name }}">{{ $category->name }}</a
                                            ><span>({{ $category->posts->count() }})</span>
                                        </li>

                                    @endforeach

                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->

@endsection

@push('js')
    <script>
        // get all comment for post
        $(document).on('click', '#showMoreBtn', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{route('front.post.getAllComments',$post->slug)}}",
                type: "GET",
                success: function (data) {
                    $('#comments').empty();
                    $.each(data, function (key, comment) {
                        $('#comments').append(`
                        <div class="comment">
                            <img src="{{asset('')}}${comment.user.image}" alt="${comment.user.name}"
                                 class="comment-img"/>
                            <div class="comment-content">
                                <span class="username">${comment.user.user_name}</span>
                                <p class="comment-text">${comment.comment}</p>
                            </div>
                        </div>
                    `);
                        $('#showMoreBtn').hide();
                    })
                },
            })
        })

        //store comment
        $(document).on('submit', '#commentForm', function (e) {
            e.preventDefault();

            let formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('front.post.comment.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#commentBox').val('');
                    $("#commentError").hide();
                    $('#comments').prepend(`
                        <div class="comment">
                            <img src="{{asset('')}}${data.comment.user.image}" alt="${data.comment.user.name}"
                                 class="comment-img"/>
                            <div class="comment-content">
                                <span class="username">${data.comment.user.user_name}</span>
                                <p class="comment-text">${data.comment.comment}</p>
                            </div>
                        </div>
                    `);
                },

                error: function (data) {
                    let response = $.parseJSON(data.responseText);
                    // let response = data.responseJSON;
                    $('#commentError').show();
                    $('#commentError').text(response.data);
                },
            });

        });
    </script>

@endpush

