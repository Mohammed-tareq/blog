<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.home') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Admin News</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="menu-toggle-icon d-xl-inline-block align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{ route('admin.home') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-home-smile-line"></i>
                <div data-i18n="Basic">Dashboard</div>
            </a>
        </li>


        {{-- users links --}}
        @can('user.read')
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ri ri-user-2-line"></i>
                    <div data-i18n="Layouts">Users</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                            <div data-i18n="Without menu">USERS</div>
                        </a>
                    </li>
                    @can('user.create')
                        <li class="menu-item">
                            <a href="{{ route('admin.users.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">Create User</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        {{-- Admin links --}}
        @can('admin.read')
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ri ri-user-2-line"></i>
                    <div data-i18n="Layouts">Admins</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('admin.admins.index') }}" class="menu-link">
                            <div data-i18n="Without menu">Admins</div>
                        </a>
                    </li>
                    @can('admin.create')
                        <li class="menu-item">
                            <a href="{{ route('admin.admins.create') }}" class="menu-link">
                                <div data-i18n="Without navbar">Create Admin</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- categories links --}}
        @can('category.read')

            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ri ri-blogger-line"></i>
                    <div data-i18n="Layouts">Categories</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('admin.categories.index') }}" class="menu-link">
                            <div data-i18n="Without menu">Categories</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        {{-- Posts links --}}
        @can('post.read')
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ri ri-pencil-line"></i>
                    <div data-i18n="Layouts">Posts</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('admin.posts.index') }}" class="menu-link">
                            <div data-i18n="Without menu">Posts</div>
                        </a>
                    </li>
                    @can('post.create')
                        <li class="menu-item">
                            <a href="{{ route('admin.posts.create') }}" class="menu-link">
                                <div data-i18n="Without menu">Create Post</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        {{-- Authorization links --}}
        @can('role.read')
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ri ri-lock-line"></i>
                    <div data-i18n="Layouts">Roles</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('admin.authorizations.index') }}" class="menu-link">
                            <div data-i18n="Without menu">Roles</div>
                        </a>
                    </li>
                    @can('role.create')
                        <li class="menu-item">
                            <a href="{{ route('admin.authorizations.create') }}" class="menu-link">
                                <div data-i18n="Without menu">Create Role</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        @can('contact.read')
            {{-- contacts links --}}
            <li class="menu-item">
                <a href="{{route('admin.contacts.index')}}" class="menu-link">
                    <i class="menu-icon icon-base ri ri-mail-line"></i>
                    <div data-i18n="Basic">Contacts</div>
                </a>
            </li>
        @endcan

        @can('notification.read')
            {{-- contacts links --}}
            <li class="menu-item">
                <a href="{{route('admin.notification.index')}}" class="menu-link">
                    <i class="menu-icon icon-base ri ri-notification-line"></i>
                    <div data-i18n="Basic">Notifications</div>
                </a>
            </li>
        @endcan

        @can('setting.read')
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ri ri-lock-line"></i>
                    <div data-i18n="Layouts">Setting</div>
                </a>

                <ul class="menu-sub">
                    {{-- Setting links --}}
                    <li class="menu-item">
                        <a href="{{route('admin.setting.index')}}" class="menu-link">
                            <i class="menu-icon icon-base ri ri-tools-line"></i>
                            <div data-i18n="Basic">Settings</div>
                        </a>
                    </li>

                    {{-- Setting links --}}
                    <li class="menu-item">
                        <a href="{{route('admin.setting.site.index')}}" class="menu-link">
                            <i class="menu-icon icon-base ri ri-tools-line"></i>
                            <div data-i18n="Basic">Sites</div>
                        </a>
                    </li>
                </ul>
            </li>

        @endcan


        <!-- Cards -->
        <li class="menu-item">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon icon-base ri ri-bank-card-2-line"></i>
                <div data-i18n="Basic">Cards</div>
            </a>
        </li>


    </ul>
</aside>