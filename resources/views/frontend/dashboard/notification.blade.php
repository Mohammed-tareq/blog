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
                        <a href="" class="btn btn-danger float-right">Mark All As Read</a>
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                </div>
                <a href="">
                    <div class="notification alert alert-info">
                        <strong>Info!</strong> This is an informational notification.
                        <div class="float-right">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="notification alert alert-warning">
                        <strong>Warning!</strong> This is a warning notification.
                        <div class="float-right">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="notification alert alert-success">
                        <strong>Success!</strong> This is a success notification.
                        <div class="float-right">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection