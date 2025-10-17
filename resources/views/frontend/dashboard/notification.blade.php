@extends('layouts.frontend.app')

@section('title')
    Profile | Notification
@endsection

@section('breadcrumb-hide',true)


@section('content')
    <div class="dashboard container">

        @include('layouts.frontend.inc.dashboard.profile-side',['notificationActive' => 'active'])
        <!-- Main Content -->
        <div class="main-content mt-5 col-md-9">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('front.dashboard.profile.notification.deleteAll')}}"
                           class="btn btn-danger float-right">Delete All Notifications</a>
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-10 col-md-12">
                        @forelse($notifications as $notification)
                            <a href="{{ $notification->data['link'] }}?notifiy={{ $notification->id }}"
                               class="Notification-class">
                                <div class="notification alert alert-warning d-flex justify-content-between align-items-center">
                                    <strong>Notify</strong> Comment in your
                                    post: {{ substr($notification->data['post_title'], 0, 10) }}
                                    BY {{ $notification->data['user_name'] }}
                                        <a href="{{ route('front.dashboard.profile.notification.delete', $notification->id) }}"
                                           class="btn btn-dark text-white btn-sm "><b>Delete </b>
                                        </a>
                                </div>
                            </a>
                        @empty
                            <div class="alert alert-info">No notifications</div>
                        @endforelse
                    </div>


                </div>


            </div>
        </div>
    </div>
@endsection

