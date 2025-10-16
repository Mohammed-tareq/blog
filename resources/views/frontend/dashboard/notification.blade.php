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
                <div class="Notification-list">

                @forelse($notifications as $notification)
                    <a href="{{ $notification->data['link'] }}?notifiy={{ $notification->id }}" class="Notification-class">
                        <div class="notification alert alert-info">
                            <strong>Notify</strong> Comment in your
                            post: {{ substr($notification->data['post_title'], 0, 10) }}
                            BY {{ $notification->data['user_name'] }}
                            <div class="float-right">
                                <button  data-id="{{ $notification->id }}"
                                        class="btn btn-danger btn-sm deleteNotifiy">Delete
                                </button>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="alert alert-info">No notifications</div>
                @endforelse
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')

    <script>


        $(document).on('click', ".deleteNotifiy", function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('front.dashboard.profile.notification.delete', ":id") }}".replace(':id', id),
                type: "GET",
                success: function (data) {
                    $(".Notification-list").empty();
                    if (data.data.length === 0) {
                        $(".Notification-list").append('<div class="alert alert-info">No notifications</div>');
                    } else {
                    $.each(data.data, function (index, value) {
                        $(".Notification-list").append(
                            ` <a href="${value.data.link}?notifiy=${value.id}" class="Notification-class">
                        <div class="notification alert alert-info">
                            <strong>Notify</strong> Comment in your
                            post: ${value.data.post_title.substring(0, 10)}...
                            BY ${value.data.user_name}
                            <div class="float-right">
                                <button  data-id="${value.id}"
                                        class="btn btn-danger btn-sm deleteNotifiy">Delete
                                </button>
                            </div>
                        </div>
                    </a>`)
                    })
                }},
                error: function (data) {
                    $responce = data.responseJSON;
                    console.log($responce);
                }
            });
        })
    </script>


@endpush