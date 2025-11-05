@extends('layouts.admin.app')

@section('title')
    Contacts
@endsection

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Contacts Data</h5>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Refresh Search</a>
        </div>
        @include('admin.contact.filter.search-filter')
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ substr($contact->title,0,15) }}...</td>
                        <td>{{ $contact->created_at->diffForHumans() }}</td>

                        <td>
                            <span class="badge rounded-pill @if($contact->status === 0) bg-label-danger @else bg-label-success @endif me-1">{{ $contact->status === 0 ? 'Inactive' : 'Active' }}</span>
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
                                    @can('contact.update')
                                    <a class="dropdown-item" href="{{ route('admin.contacts.show', $contact->id) }}">
                                        <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                        Show Massage</a
                                    >
                                    @endcan
                                    @can('contact.delete')
                                    <a class="dropdown-item" href="javascript:void(0)"
                                       onclick="submitDeleteForm({{$contact->id}})">
                                        <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Delete</a
                                    >
                                    @endcan
                                    <form id='fromId-{{ $contact->id }}'
                                          action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
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
                        <td colspan="6" class="text-center">No Contacts Found</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

                {{ $contacts->appends(request()->input())->links() }}
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
