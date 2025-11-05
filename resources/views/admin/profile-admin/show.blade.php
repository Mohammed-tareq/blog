@extends('layouts.admin.app')

@section('title')
    Admin Profile
@endsection

@section('content')

    <!-- Account -->
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Show Account DATA for {{ auth('admin')->user()->name }} </h5>
        </div>

        <div class="card-body mt-5">

            <div class="row mt-1 g-5">
                <div class="col-md-6 form-control-validation">
                    <div class="form-floating form-floating-outline">
                        <input
                                class="form-control"
                                type="text"
                                id="firstName"
                                disabled
                                readonly
                                value="{{auth('admin')->user()->name}}"
                                autofocus/>
                        <label for="firstName">Name</label>
                    </div>
                </div>
                <div class="col-md-6 form-control-validation">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" readonly disabled id="lastName"
                               value="{{auth('admin')->user()->user_name}}"/>
                        <label for="lastName">Admin User Name</label>
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
                                value="{{auth('admin')->user()->email}}"
                                placeholder="john.doe@example.com"/>
                        <label for="email">Email</label>
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
                                value="{{auth('admin')->user()->authoriz->role}}"
                                placeholder="john.doe@example.com"/>
                        <label for="email">Role</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <select id="country" class="select2 form-select" name="status">
                            <option selected
                                    disabled>{{ auth('admin')->user()->status === 1 ? 'Active' : 'Inactive' }}</option>
                        </select>
                        <label for="country">Status</label>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!-- /Account -->

@endsection