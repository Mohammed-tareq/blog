<!-- Nav Bar Start -->

@php
    $categories =  $categories_share->take(5);
@endphp
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">

            <a href="#" class="navbar-brand">MENU</a>
            <button
                    type="button"
                    class="navbar-toggler"
                    data-toggle="collapse"
                    data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                    class="collapse navbar-collapse justify-content-between"
                    id="navbarCollapse"
            >
                <div class="navbar-nav mr-auto">
                    <a href="{{route('front.index')}}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a
                                href="#"
                                class="nav-link dropdown-toggle"
                                data-toggle="dropdown"
                        >Categories</a
                        >
                        <div class="dropdown-menu">
                            @foreach($categories as $category)
                                <a href="{{ route('front.category', $category->slug) }}" title="{{ $category->name }}"
                                   class="dropdown-item">{{ $category->name }}</a>

                            @endforeach
                        </div>
                    </div>

                    <a href="{{route('front.dashboard.profile')}}" title="Dashboard"
                       class="nav-item nav-link">Dashboard</a>
                    <a href="{{ route('front.contact.index') }}" title="Contact Us" class="nav-item nav-link">Contact
                        Us</a>
                </div>
                <div class="social ml-auto">

                    @auth

                        <a href="#" class="nav-link dropdown-toggle position-relative" id="notificationDropdown"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-danger position-absolute" id="notificationCount"
                                  style="top: 7px; right: 6px; transform: translate(50%, -50%);">{{ auth()->user()->unreadNotifications()->count() ?? " "}}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="notificationDropdown"
                             style="width: 320px; max-height: 400px; overflow-y: auto;">
                            <div class="d-flex justify-content-between align-items-center" id="deleteAllNotification">
                                <h6 class="dropdown-header text-primary">Notifications</h6>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <a href="{{route('front.dashboard.profile.notification.markAll')}}" class="btn  btn-sm" ><i
                                                class="fas fa-trash"></i>
                                        <b>Delete All</b></a>
                                @endif
                            </div>

                            <div id="notification-list-id">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <div class="dropdown-item d-flex justify-content-between align-items-center notification-class ">
                                    <span style="max-width: 200px; "><a
                                                href="{{ $notification->data['link'] }}?notifiy={{ $notification->id }}"> New Comment Post: {{ substr($notification->data['post_title'], 0, 10) }}</a></span>
                                    </div>
                                @empty
                                    <div class="dropdown-item text-muted text-center" id="no-notify">No new
                                        notifications
                                    </div>
                                @endforelse
                            </div>

                        </div>
                    @endauth

                    <a href="{{ $setting->facebook }}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $setting->twitter}}" title="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $setting->linkedin }}" title="linkedin"><i class="fab fa-linkedin-in"></i></a>
                    <a href="{{ $setting->instagram }}" title="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $setting->youtube }}" title=""><i class="fab fa-youtube"></i></a>
                </div>


            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->

