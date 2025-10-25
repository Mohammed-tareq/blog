@extends('layouts.admin.app')

@section('title')
    Users Show
@endsection

@section('content')

    <!-- Account -->
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Show Account DATA for  {{ $user->user_name }} </h5>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back</a>
        </div>


            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-6">
                    <img
                            src="{{asset($user->image)}}"
                            alt="user-avatar"
                            class="d-block w-px-100 h-px-100 rounded"
                            id="uploadedAvatar"/>
                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">{{$user->name}}</h4>
                        <p class="mb-0">{{$user->user_name}}</p>
                    </div>
                </div>
            </div>
        <div class="card-body mt-5">
            <form id="formAccountSettings" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="row mt-1 g-5">
                    <div class="col-md-6 form-control-validation">
                        <div class="form-floating form-floating-outline">
                            <input
                                    class="form-control"
                                    type="text"
                                    id="firstName"
                                    disabled
                                    readonly
                                    value="{{$user->name}}"
                                    autofocus/>
                            <label for="firstName">Name</label>
                        </div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="text" readonly disabled id="lastName"
                                   value="{{$user->user_name}}"/>
                            <label for="lastName">User Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    readonly
                                    disabled
                                    value="{{$user->email}}"
                                    placeholder="john.doe@example.com"/>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <input
                                        type="text"
                                        id="phoneNumber"
                                        readonly
                                        disabled
                                        value="{{$user->phone}}"
                                        class="form-control"
                                        placeholder="202 555 0111"/>
                                <label for="phoneNumber">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                    type="text"
                                    class="form-control"
                                    readonly
                                    disabled
                                    id="address"
                                    value="{{ $user->country??"user Not Add Country" }}"
                                    placeholder="Address"/>
                            <label for="address">Country</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                    class="form-control"
                                    type="text"
                                    readonly
                                    disabled
                                    id="state"
                                    value="{{ $user->city??"User Not Add city" }}">
                            <label for="state">City</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input
                                    type="text"
                                    class="form-control"
                                    readonly
                                    disabled
                                    value="{{$user->street??"User Not Add street"}}"
                                    id="street"
                            />
                            <label for="street">Street</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="country" class="select2 form-select" name="status">
                                <option @selected($user->status == '1' ) value="1">Active</option>
                                <option @selected($user->status == '0' ) value="0">Inactive</option>
                            </select>
                            <label for="country">ٍStatus</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="country" class="select2 form-select" name="email_verify">
                                <option @selected($user->email_verified_at != null) value="1">Active</option>
                                <option @selected($user->email_verified_at == null) value="0">Inactive</option>
                            </select>
                            <label for="country">Email verify</label>
                        </div>
                    </div>


                </div>
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3">Save changes</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /Account -->

    <div class="card mt-6">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <form id="formAccountDeactivation" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger deactivate-account">
                    Delete Account
                </button>
            </form>
        </div>
    </div>
@endsection