@extends('layouts.admin.app')
@section('title')
    Notifications
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-10  card mt-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-header m-2">Notifications</h5>
                @can('notification.delete')
                    <div class="card-header m-2">
                        <a href="{{ route('admin.notification.delete-all') }}"
                           class="btn btn-danger text-white deleteComment">Delete All</a>
                    </div>
                @endcan
            </div>
            <div class="card-body" id="comments">
                @can('notification.read')
                    @forelse($notifications as $notification)
                        <div class="mb-2">

                            <p class="mb-2">
                                <span class="text-dark">{{ $notification->data['name'] }}</span>
                            </p>
                            <div class="d-flex justify-content-between">

                                <div class="d-flex flex-column justify-content-between">
                                    <p class="mb-2">
                                        <span class="fw-bold text-primary">{{ $notification->data['title'] }}</span>
                                    </p>

                                    <p class="text-dark text-sm">{{ $notification->data['email'] }}</p>
                                </div>
                                @can('notification.delete')
                                    <div>
                                        <a href="{{ route('admin.notification.delete', $notification->id) }}"
                                           class="btn btn-danger text-white deleteComment">Delete</a>
                                    </div>
                                @endcan
                            </div>

                        </div>
                    @empty
                        <p>No Notifications yet.</p>
                    @endforelse
                @endcan


            </div>
        </div>

    </div>

@endsection

