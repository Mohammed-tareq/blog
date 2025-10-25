@extends('layouts.admin.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <link rel="stylesheet" href="{{ asset('assets/front/vendor/front/file-input/css/fileinput.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">

@endpush
@section('title')
    Users Create
@endsection

@section('content')
    <div class="row mb-6 gy-6">

        <!-- Merged -->
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Post</h5>

                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back</a>

                </div>
                <div class="card-body">
                    <form id="createPostForm" action="{{route('admin.posts.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" placeholder="Enter Post Title">
                                    @error('title')
                                    <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                    <input name="tags" id="tagsInput" class="form-control"
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
                                        ></textarea>
                                @error('small_desc')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                            <div class="col-md-12 mt-4">
                                        <textarea
                                                class="form-control"
                                                id="postDescription" name="description"
                                                placeholder="Write your post description here..."
                                        ></textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>


                            <div class="col-md-12 mt-4">
                                <div class="mb-4">
                                    <input name="image[]" accept="image/*" multiple type="file" id="postImage"/>
                                </div>
                                @error('image')
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
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
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
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input type="checkbox" name="comment_able" id="comment_able" class="form-check-input"
                                       checked>
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