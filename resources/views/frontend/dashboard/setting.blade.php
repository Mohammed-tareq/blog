@extends('layouts.frontend.app')

@section('title')
    Profile | Setting
@endsection

@section('breadcrumb-hide',true)


@section('content')
    <div class="dashboard container">
            @include('layouts.frontend.inc.dashboard.profile-side',['settingActive' => 'active'])

        <!-- Main Content -->
        <div class="main-content">
            <!-- Settings Section -->
            <section id="settings" class="content-section">
                <h2>Settings</h2>
                <form class="settings-form" action="{{ route('front.dashboard.profile.setting.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" name="name"  id="username" value="{{ $user->name }}" />
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="user_name" id="username" value="{{ $user->user_name }}" />
                    </div>
                    @error('user_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" />
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="email">Phone:</label>
                        <input type="text" name="phone" id="phone" value="{{ $user->phone }}" />
                    </div>
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="profile-image">Profile Image:</label>
                        <input type="file" id="profile-image"  name="image" />
                    </div>
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input
                                type="text"
                                name="country"
                                id="country"
                                placeholder="Enter your country"
                                value="{{ $user->country }}"
                        />
                    </div>
                    @error('country')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" value="{{ $user->city }}" placeholder="Enter your city" />
                    </div>
                    @error('city')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input type="text" name="street" value="{{ $user->street }}" id="street" placeholder="Enter your street" />
                    </div>
                    @error('street')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="save-settings-btn">
                        Save Changes
                    </button>
                </form>

                <!-- Form to change the password -->
                <form class="change-password-form" action="{{ route('front.dashboard.profile.setting.update-password') }}" method="POST">
                  @csrf
                   @method('PUT')
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input
                                type="password"
                                name="current_password"
                                id="current-password"
                                placeholder="Enter Current Password"
                        />
                    </div>
                    @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input
                                type="password"
                                name="new_password"
                                id="new-password"
                                placeholder="Enter New Password"
                        />
                    </div>
                    @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input
                                type="password"
                                name="new_password_confirmation"
                                id="confirm-password"
                                placeholder="Enter Confirm New "
                        />
                    </div>
                    <button type="submit" class="change-password-btn">
                        Change Password
                    </button>
                </form>
            </section>
        </div>    </div>

@endsection