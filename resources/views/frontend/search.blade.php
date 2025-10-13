@extends('layouts.frontend.app')

@section('title')
    Search
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Search</li>
@endsection

@section('content')

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="mn-img">
                                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}">
                                    <div class="mn-title">
                                        <a href="{{ route('front.post.single-post' , $post->slug) }}"
                                           title="{{ $post->title }}">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-md-12">
                                    <div class="alert alert-danger text-center">
                                        No posts found.
                                    </div>
                                </div>
                        @endforelse


                    </div>
                    {{$posts->links()}}
                </div>


            </div>
        </div>
    </div>
    <!-- Main News End-->

@endsection
