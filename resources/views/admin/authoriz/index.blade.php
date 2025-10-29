@extends('layouts.admin.app')

@section('title')
    Admins
@endsection

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Admins Data</h5>
            <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">Refresh Search</a>
        </div>
        @include('admin.user.filter.search-filter')
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($admins as $admin)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->user_name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->created_at->format('Y-m-d') }}</td>

                        <td>
                            <span class="badge rounded-pill @if($admin->status === 0) bg-label-danger @else bg-label-success @endif me-1">{{ $admin->status === 0 ? 'Inactive' : 'Active' }}</span>
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
                                    <a class="dropdown-item" href="{{ route('admin.admins.status', $admin->id) }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Change Status</a
                                    >
                                    <a class="dropdown-item" href="{{ route('admin.admins.show', $admin->id) }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Show Admin</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="submitDeleteForm({{$admin->id}})">
                                        <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Delete</a
                                    >
                                    <form id='fromId-{{ $admin->id }}'
                                          action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST"
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
                        <td colspan="6" class="text-center">No Admins Found</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

                {{ $admins->appends(request()->input())->links() }}
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
