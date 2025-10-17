@extends('layouts.frontend.app')

@section('description')
    {{ $category->description }}
@endsection
@section('title')

    Category {{$category->name}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{$category->name}}</li>
@endsection

@section('content')

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ asset($post->images->first()->path) }}" alt="{{ $post->title }}">
                                    <div class="mn-title">
                                        <a href="{{route('front.post.single-post' , $post->slug)}}" title="{{$post->title}}">{{$post->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center alert alert-danger">
                            <h1> No Posts In This Category Yet</h1>
                            </div>
                        @endforelse


                    </div>
                        {{$posts->links()}}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Other Categories</h2>
                        <ul>
                            @foreach($categories_share as $category)

                                <li><a href="{{ route('front.category' , $category->slug) }}" title="{{ $category->name }}">{{ $category->name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection