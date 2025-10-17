@extends('layouts.frontend.app')

@section('title')
    Profile | Notification
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Profile</li>
    <li class="breadcrumb-item active">Notification</li>
@endsection

@section('content')
    <div class="dashboard container">

        @include('layouts.frontend.inc.dashboard.profile-side')
        <!-- Main Content -->
        <div class="main-content mt-5 col-md-9">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('front.dashboard.profile.notification.deleteAll')}}" class="btn btn-danger float-right">Delete All Notifications</a>
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                </div>

                @forelse($notifications as $notification)
                    <a href="{{ $notification->data['link'] }}?notifiy={{ $notification->id }}" class="Notification-class">
                        <div class="notification alert alert-warning">
                            <strong>Notify</strong> Comment in your
                            post: {{ substr($notification->data['post_title'], 0, 10) }}
                            BY {{ $notification->data['user_name'] }}
                            <div class="float-right">
                                <a href="{{ route('front.dashboard.profile.notification.delete', $notification->id) }}"
                                        class="btn btn-dark text-white btn-sm "><b>Delete </b>
                                </a>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="alert alert-info">No notifications</div>
                @endforelse


            </div>
        </div>
    </div>
@endsection

