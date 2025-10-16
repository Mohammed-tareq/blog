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
                class="list-group-item list-group-item-action {{request()->routeIs('front.dashboard.profile') ? 'active' : ''}} menu-item"
                data-section="profile"
        >
            <i class="fas fa-user"></i> Profile
        </a>
        <a
                href="{{route('front.dashboard.profile.notification.index')}}"
                class="list-group-item list-group-item-action {{ request()->routeIs('front.dashboard.profile.notification.index') ? 'active' : '' }} menu-item"
                data-section="notifications"
        >
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a
                href="{{route('front.dashboard.profile.setting.index')}}"
                class="list-group-item list-group-item-action {{request()->routeIs('front.dashboard.profile.setting.index') ? 'active' : ''}}  menu-item"
                data-section="settings"
        >
            <i class="fas fa-cog"></i> Settings
        </a>
    </div>
</aside>