<x-layouts.guest-layout>

     <x-slot name="title">
        Search Result
    </x-slot>

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->path }}"/>
                                    <div class="mn-title">
                                        <a href="{{ route('front.show.post', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="pagination justify-content-center text-center">
                          {{ $posts->links() }}
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Main News End-->
</x-layouts.guest-layout>
