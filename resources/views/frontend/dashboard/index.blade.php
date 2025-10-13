@extends('layouts.frontend.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(Auth::user()->image) }}" alt="User Image" class="rounded-circle mb-2"
                     style="width: 80px; height: 80px; object-fit: cover"/>
                <h5 class="mb-0" style="color: #ff6f61">{{ Auth::user()->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{route('front.dashboard.profile')}}"
                   class="list-group-item list-group-item-action active menu-item"
                   data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="./notifications.html" class="list-group-item list-group-item-action menu-item"
                   data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="./setting.html" class="list-group-item list-group-item-action menu-item"
                   data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{asset(Auth::user()->image)}}" alt="User Image" class="profile-img rounded-circle"
                         style="width: 100px; height: 100px;"/>
                    <span class="username">{{ Auth::user()->name }}</span>
                </div>
                <br>

                <!-- Add Post Section -->
                <form action="{{route('front.dashboard.post.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input type="text" name="title" id="postTitle" class="form-control mb-2"
                                   placeholder="Post Title"/>

                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <!-- Post Content -->
                            <textarea id="postContent" class="form-control mb-3" rows="3"
                                      name="description" placeholder="What's on your mind?"></textarea>

                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                            <!-- Image Upload -->
                            <input type="file" id="postImage" name="images[]" class="form-control mb-2" accept="image/*"
                                   multiple/>
                            <div class="tn-slider mb-2 text-center">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>
                            @error('images')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                            <!-- Category Dropdown -->
                            <select id="postCategory" name="category_id" class="form-select mb-2">
                                <option selected disabled>Select Category</option>
                                @foreach($categories_share as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                            <!-- Enable Comments Checkbox -->
                            <label class="form-check-label mb-2 d-block mx-4">
                                <input name="comment_able" type="checkbox" class="form-check-input"/> Enable Comments
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>
                </form>

                <!-- Posts Section -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        @forelse($posts as $post)
                            <!-- Post Item -->
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{asset(auth()->user()->image)}}" alt="User Image"
                                         class="rounded-circle"
                                         style="width: 50px; height: 50px;"/>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <h4 class="post-title">{{$post->title}}</h4>
                                <p class="post-content"> {!!   chunk_split($post->description,40) !!} </p>

                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">

                                    <ol class="carousel-indicators">
                                        @foreach($post->images as $count_of_silde)
                                            <li data-target="#newsCarousel" data-slide-to="{{$loop->index}}"
                                                class="{{$loop->first ? 'active': ''}}">{{$loop->index}}</li>
                                        @endforeach

                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach($post->images as $post_image)
                                            <div class="carousel-item  {{$loop->first  ? 'active': ''}}">
                                                <img src="{{asset($post_image->path)}}" class="d-block w-100"
                                                     alt="{{$post->title}}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#newsCarousel" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#newsCarousel" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                        <!-- View Count -->
                                        <span class="me-3">
                                  <i class="fas fa-eye"></i> {{ $post->num_of_views }}
                              </span>
                                    </div>

                                    <div>
                                        <a href="{{route('front.dashboard.post.update' , $post->slug)}}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)" onclick="if(confirm('Are you sure you want to delete this post?')){
                                            document.getElementById('formDelete_{{$post->id}}').submit();} return false;"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-thumbs-up"></i> Delete
                                        </a>
                                        <button id="btnCommentForPost-{{ $post->id }}" post-id="{{$post->id}}"
                                                class="btn btn-sm btn-outline-secondary btnCommentForPost">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>

                                        <button id="btnHideCommentForPost-{{ $post->id }}" post-id="{{$post->id}}"
                                                class="btn btn-sm btn-outline-secondary btnHideCommentForPost" style="display: none">
                                            <i class="fas fa-comment"></i> Hide Comments
                                        </button>

                                        <form id="formDelete_{{$post->id}}"
                                              action="{{route('front.dashboard.post.destroy')}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{$post->id}}">

                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div class="comments" id="comments-{{$post->id}}" style="display: none">

                                    <!-- Add more comments here for demonstration -->
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info text-center">
                                You have no posts yet.
                            </div>
                        @endforelse

                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection

@push('js')

    <script>

        $(function () {
            $('#postImage').fileinput({
                theme: 'fa5',
                types: 'jpg,png,gif,jpeg,webp',
                maxFilesNum: 5,
                showUpload: false,
                showClose: false,
                showCaption: false,
                browseClass: "btn btn-primary btn-sm",
                removeClass: "btn btn-danger btn-sm",
                previewFileIcon: "<i class='fas fa-file'></i>",
                allowedFileExtensions: ["jpg", "png", "gif"],

            });

            $("#postContent").summernote({
                placeholder: "Write your post title here...",
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen']]
                ]
            });

        })

        $(document).on('click', '.btnCommentForPost', function (e) {
            e.preventDefault();
            let postId = $(this).attr('post-id');

            $.ajax({
                url: "{{route('front.dashboard.post.getComments', ":post-Id")}}".replace(':post-Id', postId),
                type: "GET",
                success: function (data) {
                    $('#comments-'+postId).empty();
                    $.each(data.comments, function (index, comment) {
                        $('#comments-'+postId).append(`
                        <div class="comment">
                        <img src="{{asset("")}}${comment.user.image}" alt="${comment.user.name}"
                             class="comment-img"/>
                        <div class="comment-content">
                            <span class="username">${comment.user.name}</span>
                            <p class="comment-text">${comment.comment}</p>
                        </div>
                    </div>`).show();
                    });
                    $('#btnCommentForPost-'+postId).hide();
                    $('#btnHideCommentForPost-'+postId).show();

                },
                error: function (data) {
                    let response = data.responseJSON;
                }
            });
        });

        $(document).on('click', '.btnHideCommentForPost', function (e) {
            e.preventDefault();
            let postId = $(this).attr('post-id');
            $('#comments-'+postId).empty();
            $('#btnHideCommentForPost-'+postId).hide();
            $('#btnCommentForPost-'+postId).show();
            $()

        })
    </script>

@endpush
