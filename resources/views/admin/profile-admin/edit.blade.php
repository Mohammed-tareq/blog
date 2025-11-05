@extends('layouts.admin.app')

@section('title')
    Admin Profile Edit
@endsection

@section('content')

    <!-- Account -->
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Edit Account DATA for {{ auth('admin')->user()->name }} </h5>
        </div>

        <form action="{{ route('admin.profile.check.email') }}" method="post">
            @csrf
            <div class="card-body mt-5">

                <div class="row mt-1 g-5">
                    <div class="col-md-6 form-control-validation">
                        <div class="form-floating form-floating-outline">
                            <input
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    id="firstName"
                                    value="{{auth('admin')->user()->name}}"
                                    autofocus/>
                            <label for="firstName">Name</label>
                        </div>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text"  name="user_name"  id="lastName"
                                   value="{{auth('admin')->user()->user_name}}"/>
                            <label for="lastName">Admin User Name</label>
                        </div>
                        @error('user_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    name="email"
                                    value="{{auth('admin')->user()->email}}"
                                    placeholder="john.doe@example.com"/>
                            <label for="email">Email</label>
                        </div>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="status" class="select2 form-select" >
                                <option disabled @selected(auth('admin')->user()->status === 1) value="1">Active</option>
                                <option disabled @selected(auth('admin')->user()->status === 0) value="0">Inactive</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                    name="password"
                                    class="form-control"
                                    type="password"
                                    id="password"
                                    placeholder="password"/>
                            <label for="password">Password</label>
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                    name="password_confirmation"
                                    class="form-control"
                                    type="password"
                                    id="confirmPassword"
                                    placeholder="Enter password Again"/>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>
                        @error('confirmPassword')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary me-3">Edit Profile</button>
                    </div>

                </div>

            </div>
        </form>

    </div>
    <!-- /Account -->

@endsection