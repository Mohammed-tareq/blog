@extends('layouts.admin.app')

@section('title')
    Admin Edit
@endsection

@section('content')
    <div class="row mb-6 gy-6">

        <!-- Merged -->
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Admin</h5>

                    <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">Back</a>

                </div>
                <div class="card-body">
                    <form action="{{route('admin.admins.update',$admin->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-user-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="name"
                                                value="{{ $admin->name }}"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Name"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Full Name</label>
                                    </div>
                                </div>
                                @error('name')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-user-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="user_name"
                                                value="{{ $admin->user_name }}"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Admin Name"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Admin Name</label>
                                    </div>
                                </div>
                                @error('user_name')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="icon-base ri ri-mail-line"></i></span>
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                    type="text"
                                                    id="basic-icon-default-email"
                                                    class="form-control"
                                                    placeholder="Enter Email"
                                                    name="email"
                                                    value="{{ $admin->email }}"
                                                    aria-describedby="basic-icon-default-email2"/>
                                            <label for="basic-icon-default-email">Email</label>
                                        </div>
                                        <span id="basic-icon-default-email2"
                                              class="input-group-text">@example.com</span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                    <select class="form-select" name="status" id="inputGroupSelect01">
                                        <option selected="selected" disabled>Choose...</option>
                                        <option @selected($admin->status === 1) value="1">Active</option>
                                        <option @selected($admin->status === 0) value="0">Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                                    <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                    <select class="form-select" name="authoriz_id" id="inputGroupSelect01">
                                        <option selected="selected" disabled>Choose...</option>
                                        @forelse($authoriz as $auth)
                                            <option @selected($admin->authoriz_id === $auth->id) value="{{ $auth->id }}">{{ $auth->role }}</option>

                                        @empty
                                            <option disabled>No Role Found</option>
                                        @endforelse

                                    </select>
                                </div>
                                @error('authoriz_id')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-phone2" class="input-group-text"
                          ><i class="icon-base ri  ri-eye-off-line icon-20px"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="password"
                                                name="password"
                                                id="basic-icon-default-phone"
                                                class="form-control password-mask"
                                                placeholder="Enter password"
                                                aria-describedby="basic-icon-default-phone2"/>
                                        <label for="basic-icon-default-phone">Password</label>
                                    </div>
                                </div>
                                @error('password')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>

                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-phone2" class="input-group-text"
                          ><i class="icon-base ri  ri-eye-off-line icon-20px"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="password"
                                                name="password_confirmation"
                                                id="basic-icon-default-phone"
                                                class="form-control password-mask"
                                                placeholder="Enter password Again"
                                                aria-describedby="basic-icon-default-phone2"/>
                                        <label for="basic-icon-default-phone"> Password Confirm</label>
                                    </div>
                                @error('password_confirmation')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                                </div>

                            </div>


                            <div class="mt-2 col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-7">edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection