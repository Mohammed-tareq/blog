    @extends('layouts.frontend.app')

    @section('title')
        Edit  {{ $post->slug}}

    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active">Edit / {{ $post->slug}}</li>
    @endsection

    @section('content')
        <div class="dashboard container">

            @include('layouts.frontend.inc.dashboard.profile-side')


            <!-- Main Content -->
            <div class="main-content col-md-9">
                <!-- Show/Edit Post Section -->
                <section id="posts-section" class="posts-section">
                    <h2>Your Posts</h2>
                    <form action="{{route('front.dashboard.post.update',$post->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="list-unstyled user-posts">
                            <!-- Example of a Post Item -->
                            <li class="post-item">
                                <!-- Editable Title -->
                                <input type="text" class="form-control mb-2 post-title" name="title"
                                       value="{{$post->title}}"/>
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <!-- Editable Content -->
                                <textarea class="form-control mb-2 post-content" id="postDescription" name="description">
                                {!! $post->description !!}
                                </textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                                <!-- Image Upload Input for Editing -->
                                <input type="file" class="form-control mt-2  edit-post-image" name="images[]"
                                       id="postImageInput"
                                       accept="image/*" multiple/>

                                <!-- Editable Category Dropdown -->
                                <select class="form-control mt-2 mb-2 post-category" name="category_id">
                                    @foreach($categories_share as $category)
                                        <option  value="{{ $category->id }}" @selected($category->id == $post->category_id)> {{$category->name}}</option>
                                    @endforeach

                                </select>


                                <!-- Editable Enable Comments Checkbox -->
                                <div class="form-check mb-2">
                                    <input class="form-check-input enable-comments" name="comment_able"
                                           @checked($post->comment_able == 1) type="checkbox"/>
                                    <label class="form-check-label">
                                        Enable Comments
                                    </label>
                                </div>

                                <!-- Post Meta: Views and Comments -->
                                <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                   <span>10 <i class="fas fa-eye"></i></span>
                                </span>
                                    <span class="post-comments">
                                    <span><i class="fas fa-comment"></i> 5</span>
                                </span>
                                </div>

                                <!-- Post Actions -->
                                <div class="post-actions mt-2">
                                    <button type="submit" class="btn btn-primary edit-post-btn">Edit</button>
                                    <a href="javascript:void(0)" onclick="if(confirm('Are you sure you want to delete this post?')){
                                    document.getElementById('delete-post-form').submit();} return false;"
                                       class="btn btn-danger delete-post-btn">Delete</a>

                                </div>

                            </li>
                            <!-- Additional posts will be added dynamically -->
                        </ul>
                    </form>
                    <form action="{{route('front.dashboard.post.destroy',$post->id)}}" method="post"
                          id="delete-post-form">
                        @csrf
                        @method('DELETE')
                    </form>

                </section>
            </div>
        </div>

    @endsection

    @push('js')
        <script>
            $(function () {

                $('#postDescription').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });

                $('#postImageInput').fileinput({
                    theme: 'fa5',
                    types: 'jpg,png,gif,jpeg,webp',
                    maxFilesNum: 5,
                    showUpload: false,
                    showClose: false,
                    showCaption: false,
                    browseClass: "btn btn-primary btn-sm",
                    removeClass: "btn btn-danger btn-sm",
                    initialPreviewAsData: true,
                    initialPreview: [
                        @if($post->images->count() > 0)
                                @foreach($post->images as $image)
                                    "{{ asset( $image->path)  }}",
                                @endforeach
                        @endif
                    ],
                    initialPreviewConfig:[
                        @if($post->images->count() > 0 )
                            @foreach($post->images as $image)

                                {
                                    "caption": " Post Image{{ $loop->iteration }}",
                                    "width": "100px",
                                    "url": "{{ route('front.dashboard.post.destroy-image',  $image->id ) }}",
                                    "key": {{ $image->id }},
                                    'extra': {
                                        '_token': '{{ csrf_token() }}',
                                    }
                                },
                            @endforeach
                        @endif
                    ],
                    // msgErrorClass: 'd-none'
                });
            });

        </script>
    @endpush