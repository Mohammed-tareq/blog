<x-layouts.guest-layout>

     <x-slot name="title">
      {{$category->name}}
    </x-slot>

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active"> {{$category->name}}</li>

    @endsection
    <div class="main-news py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($post as $category_post)
                                <div class="col-md-4">
                                    <div class="mn-img">
                                        <img src="{{ $category_post->images->first()->path }}" />
                                        <div class="mn-title">
                                            <a href="{{ route('front.show.post', $category_post->slug) }}" title="{{ $category_post->title }}">{{ $category_post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                        @empty
                            <div class="text-scendery">No Post</div>
                        @endforelse

                    </div>
                    {{ $post->links() }}
                </div>


                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Other Category</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('front.category.posts', $category->slug) }}" title="{{ $category->name }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest-layout>
