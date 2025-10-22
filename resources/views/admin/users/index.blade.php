@extends('layouts.admin.app')

@section('title')
    Users
@endsection

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Users Data</h5>
      @include('admin.filter.user-filter')
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
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('fromId-{{ $user->id }}').submit();">
                                        <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                        Delete</a
                                    >
                                    <form id='fromId-{{ $user->id }}' action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')

                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-center">

                {{ $users->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

@endsection

