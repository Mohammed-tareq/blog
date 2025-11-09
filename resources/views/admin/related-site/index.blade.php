@extends('layouts.admin.app')

@section('title')
    Related Sites
@endsection

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Related Sites Data</h5>
            <div class="d-flex align-items-center gap-2">

                <a href="javascript:void(0)" data-bs-toggle="modal"
                   data-bs-target="#create-related-site" class="btn btn-primary">Create Related Site</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @forelse($relatedSites as $site)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $site->name }}</td>
                        <td><a href="{{$site->url}}" class="btn btn-primary">Visit Site</a></td>
                        <td>{{ $site->created_at->diffForHumans() }}</td>


                        <td>
                            <div class="dropdown">
                                <button
                                        type="button"
                                        class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                        data-bs-toggle="dropdown">
                                    <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                </button>
                                <div class="dropdown-menu">

                                    @can('setting.edit-social')
                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                                           data-bs-target="#edit-site-{{ $site->id }}">
                                            <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                            Edit Site</a
                                        >
                                    @endcan
                                    @can('setting.delete-social')
                                        <a class="dropdown-item" href="javascript:void(0)"
                                           onclick="submitDeleteForm({{$site->id}})">
                                            <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                            Delete</a
                                        >
                                    @endcan
                                    {{-- delete form  --}}
                                    <form id='fromId-{{ $site->id }}'
                                          action="{{ route('admin.setting.site.delete', $site->id) }}"
                                          method="POST"
                                          style="display: none;">
                                        @csrf

                                    </form>


                                </div>
                                {{--      edit model     --}}
                                @include('admin.related-site.edit',['site' => $site , 'id' => $site->id])
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Site Found</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">

                {{ $relatedSites->appends(request()->input())->links() }}
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
                text: "You won't to delete this Site!",
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
