@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.admin.app')

@section('title')
    Users
@endsection

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Posts Data</h5>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create Post</a>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Refresh Search</a>

            </div>
        </div>
        @include('admin.post.filter.search-filter')
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>User Name</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($posts as $post)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ substr($post->title, 0, 17) }}...</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->user->name ?? $post->admin->name }}</td>
                        <td>{{ $post->num_of_views }}</td>
                        <td>
                            <span class="badge rounded-pill @if($post->status === 0) bg-label-danger @else bg-label-success @endif me-1">{{ $post->status === 0 ? 'Inactive' : 'Active' }}</span>
                        </td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>


                        <td>
                            <div class="dropdown">
                                <button
                                        type="button"
                                        class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                        data-bs-toggle="dropdown">
                                    <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @can('post.update')
                                        @if(Auth::guard('admin')->check() && $post->admin_id == Auth::guard('admin')->user()->id)
                                            <a class="dropdown-item" href="{{ route('admin.posts.edit', $post->id) }}">
                                                <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                                Edit Post</a
                                            >
                                        @endif
                                    @endcan
                                    @can('post.read')
                                        <a class="dropdown-item"
                                           href="{{ route('admin.posts.show',  ['post' => $post->id , 'page'=>request()->page]) }}">
                                            <i class="icon-base ri ri-eye-line icon-18px me-1"></i>
                                            Show Post</a
                                        >
                                    @endcan
                                    @can('post.status')
                                        <a class="dropdown-item" href="{{ route('admin.posts.status', $post->id) }}">
                                            <i class="icon-base ri ri-cursor-line icon-18px me-1"></i>
                                            Change Status</a
                                        >
                                    @endcan
                                    @can('post.delete')
                                        <a class="dropdown-item" href="javascript:void(0)"
                                           onclick="submitDeleteForm({{$post->id}})">
                                            <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                            Delete</a
                                        >
                                    @endcan
                                    <form id='fromId-{{ $post->id }}'
                                          action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')

                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Posts Found</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

                {{ $posts->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

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
