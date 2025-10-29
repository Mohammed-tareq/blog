@extends('layouts.admin.app')

@section('title')
    Roles
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@endpush

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Roles Data</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($authorizations as $authoriz)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $authoriz->role }}</td>
                        <td>
                            <button class="btn btn-primary" href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#show-permissions-{{ $authoriz->id }}">
                                <i class="icon-base ri ri-eye-line icon-18px me-1"></i>
                                Permissions
                            </button
                            >
                        </td>
                        <td>{{ $authoriz->created_at->format('Y-m-d') }}</td>

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
                                       href="{{ route('admin.authorizations.edit', $authoriz->id) }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Edit Role</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="submitDeleteForm({{$authoriz->id}})">
                                        <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Delete</a
                                    >
                                    <form id='fromId-{{ $authoriz->id }}'
                                          action="{{ route('admin.authorizations.destroy', $authoriz->id) }}"
                                          method="POST"
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')

                                    </form>
                                </div>
                            </div>
                        </td>
                        @include('admin.authoriz.show', ['authoriz' => $authoriz,'id' => $authoriz->id])
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Admins Found</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

                {{ $authorizations->appends(request()->input())->links() }}
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
