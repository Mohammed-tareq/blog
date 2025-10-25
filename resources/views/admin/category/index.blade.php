@extends('layouts.admin.app')

@section('title')
    Categories
@endsection

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Categories Data</h5>
            <div class="d-flex align-items-center gap-2">

                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Refresh Search</a>
                <a href="javascript:void(0)" data-bs-toggle="modal"
                   data-bs-target="#create-category" class="btn btn-primary">Create Category</a>
            </div>
        </div> {{-- search for category --}}
        @include('admin.category.filter.search-filter')
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Number of Posts</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <span class="badge rounded-pill @if($category->status === 0) bg-label-danger @else bg-label-success @endif me-1">{{ $category->status === 0 ? 'Inactive' : 'Active' }}</span>
                        </td>
                        <td>{{ $category->posts_count }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>


                        <td>
                            <div class="dropdown">
                                <button
                                        type="button"
                                        class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                        data-bs-toggle="dropdown">
                                    <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                       href="{{ route('admin.categories.status', $category->id) }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Change Status</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                                       data-bs-target="#edit-category-{{ $category->id }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Edit Category</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="submitDeleteForm({{$category->id}})">
                                        <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Delete</a
                                    >

                                    {{-- delete form  --}}
                                    <form id='fromId-{{ $category->id }}'
                                          action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')

                                    </form>



                                </div>
                                {{--      edit model     --}}
                                @include('admin.category.edit',['category' => $category , 'id' => $category->id])
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Categories Found</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

                {{ $categories->appends(request()->input())->links() }}
            </div>
        </div>
    </div>


    {{-- bootstrap model for create category    --}}
    @include('admin.category.create')

@endsection
@push('js')

    <script>
        function submitDeleteForm(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't to delete this Category!",
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
