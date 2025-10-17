<!-- Sidebar -->
<aside class="col-md-3 nav-sticky dashboard-sidebar mt-4">
    <!-- User Info Section -->
    <div class="user-info text-center p-3">
        <img
                src="{{asset(auth()->user()->image)}}"
                alt="User Image"
                class="rounded-circle mb-2"
                style="width: 80px; height: 80px; object-fit: cover"
        />
        <h5 class="mb-0" style="color: #ff6f61">{{ auth()->user()->name }}</h5>
    </div>

    <!-- Sidebar Menu -->
    <div class="list-group profile-sidebar-menu">
        <a
                href="{{route('front.dashboard.profile')}}"
                class="list-group-item list-group-item-action {{ $profileActive ??"" }} menu-item"
                data-section="profile"
        >
            <i class="fas fa-user"></i> Profile
        </a>
        <a
                href="{{route('front.dashboard.profile.notification.index')}}"
                class="list-group-item list-group-item-action {{ $notificationActive ?? ""}} menu-item"
                data-section="notifications"
        >
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a
                href="{{route('front.dashboard.profile.setting.index')}}"
                class="list-group-item list-group-item-action {{ $settingActive ?? ''}}  menu-item"
                data-section="settings"
        >
            <i class="fas fa-cog"></i> Settings
        </a>

        <a
                href="{{$setting->whatsapp}}"
                class="list-group-item list-group-item-action  menu-item"
                data-section="settings"
        >
            <i class="fa fa-question"></i> Support
        </a>

        <a
                href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit()"
                class="list-group-item list-group-item-action {{request()->routeIs('front.dashboard.profile.setting.index') ? 'active' : ''}}  menu-item"
                data-section="settings"
        >
            <i class="fa fa-power-off"></i> Logout
        </a>
        <form id="logoutForm" action="{{route('logout')}}" method="POST" style="display: none">
            @csrf
        </form>
    </div>
</aside>