@extends('layouts.admin.app')

@section('title')
    Users
@endsection

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> User Data</h5>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Refresh Search</a>
        </div>
        @include('admin.user.filter.search-filter')
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($users as $user)
                    <tr>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->Country }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>

                        <td>
                            <span class="badge rounded-pill @if($user->status === 0) bg-label-danger @else bg-label-success @endif me-1">{{ $user->status === 0 ? 'Inactive' : 'Active' }}</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button
                                        type="button"
                                        class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                        data-bs-toggle="dropdown">
                                    <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.users.status', $user->id) }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Change Status</a
                                    >
                                    <a class="dropdown-item" href="{{ route('admin.users.show', $user->id) }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Show user</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="submitDeleteForm({{$user->id}})">
                                        <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Delete</a
                                    >
                                    <form id='fromId-{{ $user->id }}'
                                          action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
                        <td colspan="6" class="text-center">No Users Found</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

                {{ $users->appends(request()->input())->links() }}
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
                text: "You won't to delete this user!",
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
