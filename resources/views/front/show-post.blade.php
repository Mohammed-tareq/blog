<x-layouts.guest-layout>


    <!-- Breadcrumb Start -->

    <!-- Breadcrumb End -->

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($main_post->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ $image->path }}" class="d-block w-100" alt="{{$main_post->title}}">
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
                    <div class="sn-content">
                        <h2>{{ $main_post->title }}</h2>
                        <p>
                            {{ $main_post->desc }}
                        </p>
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <form id="commentForm">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $main_post->id }}">
                            <input type="hidden" name="user_id" value="1">
                            <div class="comment-input">
                                <input type="text" name="comment" placeholder="Add a comment..." id="commentBox"/>
                                <button id="addCommentBtn">Add Comment</button>
                            </div>
                        </form>

                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach($main_post->comments as $comment)

                                <div class="comment">
                                    <img src="{{$comment->user->image}}" class="comment-img"
                                         alt="{{ $comment->user->name }}"/>
                                    <div class="comment-content">
                                        <span class="username">{{$comment->user->name}}</span>
                                        <p class="comment-text">{{$comment->comment}}</p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more comments here for demonstration -->
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="sn-slider">

                            @foreach($posts_of_category as $post)

                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ $post->images->first()->path }}" class="img-fluid"
                                             alt="{{$post->title}}"/>
                                        <div class="sn-title">
                                            <a href="{{ route('front.show.post', $post->slug) }}"
                                               title="{{$post->title}}">
                                                {{ substr($post->title, 0, 20) }}</a>
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
                                @php
                                    $posts_of_category_limit = $posts_of_category->take(5);
                                @endphp
                                @foreach ($posts_of_category_limit as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ $post->images->first()->path }}" alt="{{$post->title}}"/>
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                    href="{{ route('front.show.post', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>


                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="popular" class="container tab-pane active">
                                        @foreach ( $gretest_post_news as  $post )

                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ $post->images->first()->path }}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('front.show.post', $post->slug) }}"
                                                       title="{{ $post->title }}">{{ substr($post->title, 0, 21 ) }}
                                                        comments ({{ $post->comments_count }}) </a>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>

                                    <div id="latest" class="container tab-pane fade">
                                        @foreach ($latest_post as  $post)

                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ $post->images->first()->path }}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('front.show.post', $post->slug) }}"
                                                       title="{{ $post->title }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--                        <div class="sidebar-widget">--}}
                        {{--                            <div class="image">--}}
                        {{--                                <a href="https://htmlcodex.com"><img src="img/ads-2.jpg" alt="Image"/></a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('front.category.posts', $category->slug) }}">
                                                {{ $category->name }}</a><span>({{$category->posts()->count()}})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        {{--
                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="img/ads-2.jpg" alt="Image"/></a>
                            </div>
                        </div>
                        --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->

    <x-slot name="script">
        @php
            $commentsUrl = route('front.show.post.comments', $main_post->slug);
            $addCommentUrl = route('front.show.store.post.comments',);

        @endphp
        <script>

            {{-- add comment by ajax            --}}
            $(document).on('submit', '#commentForm', function (e) {
                e.preventDefault();
                $('#addCommentBtn').prop('disabled', true).text('pending')

                let formData = new FormData(this);
                $.ajax({
                    url:"{{$addCommentUrl}}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data){
                    $('.comments').prepend(`<div class="comment">
                                <img src="${data.comment.user.image}" class="comment-img" alt="${data.comment.user.name}"/>
                                <div class="comment-content">
                                    <span class="username">${data.comment.user.name}</span>
                                    <p class="comment-text">${data.comment.comment}</p>
                                </div>
                            </div>`);

                    $('#commentBox').val("");

                    },
                    error: function(data){

                    }
                }).always(function () {
                    $('#addCommentBtn').prop('disabled', false).text('Add Comment')
                })
            })

            {{-- get more comments in ajax in frist when add comment            --}}
            $(document).on('click', '#showMoreBtn', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{$commentsUrl}}',
                    method: 'get',
                    success: function (data) {
                        $('.comments').empty();
                        $.each(data, function (key, comment) {
                            $('.comments').append(`<div class="comment">
                                <img src="${comment.user.image}" class="comment-img" alt="${comment.user.name}"/>
                                <div class="comment-content">
                                    <span class="username">${comment.user.name}</span>
                                    <p class="comment-text">${comment.comment}</p>
                                </div>
                            </div>`);
                        })
                        $('#showMoreBtn').remove();
                    },
                    error: function (data) {

                    }

                })
            });

        </script>
    </x-slot>

</x-layouts.guest-layout>
