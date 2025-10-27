@extends('layouts.admin.app')

@section('title')
    Post Show
@endsection


@push('css')
    <style>
        .custom-carousel {
            max-width: 70rem;
            height: 40rem;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .custom-carousel .carousel-image {
            width: 100%;
            height: 40rem;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 0.8rem;
            padding: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-4">
        <a href="{{ route('admin.posts.index',['page' => request()->page]) }}" class="btn btn-primary">Back</a>
    </div>
    <div class="row mb-6 gy-6 d-flex justify-content-center">

        <!-- Bootstrap carousel -->
        <div class="col-md-8">
            <h3 class="mb-4 ">{{ $post->title }}</h3>
            <div id="carouselExample" class="carousel slide custom-carousel mx-auto" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($post->images as $image)
                        <button
                                type="button"
                                data-bs-target="#carouselExample"
                                data-bs-slide-to="{{ $loop->index }}"
                                class="{{ $loop->index == 0 ? 'active' : '' }}"
                                aria-current="{{ $loop->index == 0 ? 'true' : 'false' }}"
                                aria-label="{{ $loop->index }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach ($post->images as $image)
                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                            <img class="d-block w-100 carousel-image" src="{{ asset($image->path) }}"
                                 alt="{{ $post->title }}">
                        </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>

            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Basic</h5>
                    <div class="card-body">

                        <p class="demo-inline-spacing">
                            <a
                                    class="btn btn-primary me-1"
                                    data-bs-toggle="collapse"
                                    href="#postinfo"
                                    role="button"
                                    aria-expanded="false"
                                    aria-controls="collapseExample">
                                Post Info
                            </a>
                            <button
                                    class="btn btn-primary me-1"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#postdesc"
                                    aria-expanded="false"
                                    aria-controls="collapseExample">
                                Post Description
                            </button>
                            @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->id === $post->admin_id)
                                <a
                                        class="btn btn-primary me-1"
                                        href="{{ route('admin.posts.edit', $post->id) }}">
                                    Edit Info
                                </a>
                            @endif
                            <a
                                    class="btn btn-primary me-1"
                                    href="javascript:void(0);"
                                    onclick="submitDeleteForm({{ $post->id }})"
                            >
                                Delete Post
                            </a>
                            <a
                                    class="btn btn-primary me-1"
                                    href="{{ route('admin.posts.status', $post->id) }}"

                            >
                                Change Status
                            </a>

                        <form id="fromId-{{ $post->id }}" action="{{ route('admin.posts.destroy', $post->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        </p>
                        <div class="collapse" id="postinfo">
                            <div class="d-flex flex-column justify-content-between p-3 rounded bg-light shadow-sm">
                                <p class="mb-2">
                                    <span class="fw-bold text-primary">User:</span>
                                    <span class="text-dark">{{ $post->user->name ?? $post->admin->name }}</span>
                                </p>

                                <p class="mb-2">
                                    <span class="fw-bold text-primary">User Status:</span>
                                    <span class="{{ $post->user && $post->user->status === 1 ? 'text-success' : 'text-danger' }}">
                                     {{ $post->user ? ($post->user->status === 1 ? 'Active' : 'Inactive') : 'This is Admin' }}
                                     </span>
                                </p>

                                <p class="mb-2">
                                    <span class="fw-bold text-primary">Category:</span>
                                    <span class="text-dark">{{ $post->category->name }}</span>
                                </p>

                                <p class="mb-2">
                                    <span class="fw-bold text-primary">Post Status:</span>
                                    <span class=" {{ $post->status === 1 ? 'text-success' : 'text-danger' }}">{{ $post->status ? "Active" : "Inactive" }}</span>
                                </p>

                                <p class="mb-2">
                                    <span class="fw-bold text-primary">Tags:</span>
                                    <span class="text-dark">{{ !is_null($post->tags) ? implode(', ', $post->tags) : 'No Tags' }}</span>
                                </p>

                                <p class="mb-2">
                                    <span class="fw-bold text-primary">Comment Approval:</span>
                                    <span class=" {{ $post->comment_able ? 'text-success' : 'text-danger' }}">{{ $post->comment_able ? 'Approved' : 'Not Approved' }}</span>
                                </p>
                                @if($post->comments_count > 0 && $post->comment_able == 1)
                                    <p class="mb-2">
                                        <span class="fw-bold text-primary">Num of Comments:</span>
                                        <span class=" test-dark">({{ $post->comments_count }}) </span>
                                    </p>
                                @endif

                                <p class="mb-2">
                                    <span class="fw-bold text-primary">Num of Views:</span>
                                    <span class=" test-dark">({{ $post->num_of_views }}) </span>
                                </p>


                                <p class="mb-0">
                                    <span class="fw-bold text-primary">Published At:</span>
                                    <span class="text-muted">{{ $post->created_at->format('Y-m-d') }}</span>
                                </p>
                            </div>

                        </div>

                        <div class="collapse" id="postdesc">
                            <div class="d-flex flex-column justify-content-between p-3 rounded bg-light shadow-sm">
                                <p class="mb-2">
                                    <span class="fw-bold text-primary d-block">Post Summery Description</span>
                                    <span class="text-dark">{{ $post->small_desc }}</span>
                                </p>
                                <p class="mb-2">
                                    <span class="fw-bold text-primary d-block">Post Description</span>
                                    <span class="text-dark">{!!   $post->description !!}</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @push('js')

            <script>
                function submitDeleteForm(id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't to delete this post!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#8c57ff',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(result => {
                        if (result.isConfirmed) {
                            document.getElementById('fromId-' + id).submit();
                        }
                    })

                }
            </script>

    @endpush