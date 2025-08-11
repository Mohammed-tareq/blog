<x-layouts.guest-layout>


    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">News</a></li>
                <li class="breadcrumb-item active">News details</li>
            </ul>
        </div>
    </div>
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
                            @foreach ($post->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ $image->path }}" class="d-block w-100" alt="First Slide">
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
                        <h2>{{ $post->title }}</h2>
                        <p>
                            {{ $post->desc }}
                        </p>
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <div class="comment-input">
                            <input type="text" placeholder="Add a comment..." id="commentBox" />
                            <button id="addCommentBtn">Post</button>
                        </div>

                        <!-- Display Comments -->
                        <div class="comments">
                            <div class="comment">
                                <img src="./img/news-450x350-2.jpg" alt="User Image" class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">User1</span>
                                    <p class="comment-text">This is an example comment.</p>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="./img/news-450x350-2.jpg" alt="User Image" class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">User2</span>
                                    <p class="comment-text">This is an example comment.</p>
                                </div>
                            </div>
                            <!-- Add more comments here for demonstration -->
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="img/news-350x223-1.jpg" class="img-fluid" alt="Related News 1" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="img/news-350x223-2.jpg" class="img-fluid" alt="Related News 2" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="img/news-350x223-3.jpg" class="img-fluid" alt="Related News 3" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="img/news-350x223-4.jpg" class="img-fluid" alt="Related News 4" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($posts_of_category as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ $post->images->first()->path }}" />
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
                                                <img src="{{ $post->images->first()->path }}" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="{{ route('front.show.post', $post->slug) }}" title="{{ $post->title }}">{{ substr($post->title, 0, 21 ) }} comments ({{ $post->comments_count }}) </a>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>

                                    <div id="latest" class="container tab-pane fade">
                                        @foreach ($latest_post as  $post)

                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ $post->images->first()->path }}" />
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

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="img/ads-2.jpg" alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    <li><a href="">National</a><span>(98)</span></li>
                                    <li><a href="">International</a><span>(87)</span></li>
                                    <li><a href="">Economics</a><span>(76)</span></li>
                                    <li><a href="">Politics</a><span>(65)</span></li>
                                    <li><a href="">Lifestyle</a><span>(54)</span></li>
                                    <li><a href="">Technology</a><span>(43)</span></li>
                                    <li><a href="">Trades</a><span>(32)</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="img/ads-2.jpg" alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->


</x-layouts.guest-layout>
