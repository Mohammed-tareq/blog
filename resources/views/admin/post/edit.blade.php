@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <link rel="stylesheet" href="{{ asset('assets/front/vendor/front/file-input/css/fileinput.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">

@endpush
@section('title')
    Post Edit
@endsection

@section('content')
    <div class="row mb-6 gy-6">

        <!-- Merged -->
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Post</h5>

                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back</a>

                </div>
                <div class="card-body">
                    <form id="createPostForm" action="{{route('admin.posts.update',$post->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" value="{{ old('title',$post->title) }}" name="title"
                                           class="form-control" placeholder="Enter Post Title">
                                    @error('title')
                                    <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input name="tags" id="tagsInput"  value="{{ json_encode($post->tags) }}"
                                       class="form-control"
                                       placeholder="Add Tags">
                                @error('tags')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                            <div class="col-md-12 mt-4 ">
                                        <textarea
                                                class="form-control"
                                                name="small_desc"
                                                rows="3"
                                                cols="50"
                                                placeholder="Enter Small Description"
                                        >{{ old('small_desc',$post->small_desc) }}</textarea>
                                @error('small_desc')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                            <div class="col-md-12 mt-4">
                                        <textarea
                                                class="form-control"
                                                id="postDescription" name="description"
                                                placeholder="Write your post description here..."
                                        >{!! old('description',$post->description) !!}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>


                            <div class="col-md-12 mt-4">
                                <div class="mb-4">
                                    <input name="images[]" accept="image/*" multiple type="file" id="postImage"/>
                                </div>
                                @error('images')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                    <select class="form-select" name="status" id="inputGroupSelect01">
                                        <option selected="selected" disabled>Choose...</option>
                                        <option @selected($post->status == 1) value="1">Active</option>
                                        <option @selected($post->status == 0) value="0">Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                                    <label class="input-group-text" for="inputGroupSelect01">Category</label>
                                    <select class="form-select" name="category_id" id="inputGroupSelect01">
                                        <option selected="selected" disabled>Choose...</option>
                                        @foreach($categories_share as $category)
                                            <option @selected($post->category_id == $category->id) value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input type="checkbox" name="comment_able" id="comment_able" class="form-check-input"
                                        @checked($post->comment_able)>
                                <label for="comment_able" class="form-check-label">Comment Able</label>

                            </div>


                            <div class="mt-2 col-12">
                                <button type="button" onclick="submitForm()" class="btn btn-primary btn-lg px-7">Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/front/vendor/front/file-input/js/fileinput.min.js')}}"></script>
    <script src="{{asset('assets/front/vendor/front/file-input/themes/fa5/theme.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

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
                initialPreviewAsData: true,
                initialPreview: [
                    @if($post->images->count() > 0)
                        @foreach($post->images as $image)
                            "{{asset($image->path)}}",
                        @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                    @if($post->images->count() > 0)
                            @foreach($post->images as $image)
                    {
                        "caption": " Post Image{{ $loop->iteration }}",
                        "width": "100px",
                        "url": "{{ route('admin.posts.delete-image',  $image->id ) }}",
                        "key": {{ $image->id }},
                        'extra': {
                            '_token': '{{ csrf_token() }}',
                        },
                        'method':'POST'
                    },
                    @endforeach
                    @endif
                ],
                // msgErrorClass: 'd-none'
            });

            $("#postDescription").summernote({
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        let input = document.querySelector('#tagsInput');
        new Tagify(input);
    </script>

    <script>
        function submitForm() {
            document.getElementById('createPostForm').submit();
        }

    </script>
@endpush