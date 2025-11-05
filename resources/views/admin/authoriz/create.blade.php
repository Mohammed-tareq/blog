@extends('layouts.admin.app')

@section('title')
    Role Create
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@endpush

@section('content')
    <div class="row mb-6 gy-6">

        <!-- Merged -->
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Role</h5>

                    <a href="{{ route('admin.authorizations.index') }}" class="btn btn-primary">Back</a>

                </div>
                <div class="card-body">
                    <form action="{{route('admin.authorizations.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="bi bi-person-gear"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="role"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Name"
                                               />
                                        <label for="basic-icon-default-fullname">Role Name</label>
                                    </div>
                                </div>
                                @error('role')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            @foreach(config('authoriz.permission') as $groupKey => $permissionsName)
                                <div class="col-md-12 mt-3">
                                    <h3><b>{{ucfirst($groupKey)}} Permission</b></h3>
                                </div>
                                <div class="col-md-12 d-flex justify-content-evenly gap-3">
                                    @foreach($permissionsName as $key => $value)
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" name="permissions[]" value="{{ $groupKey.".".$key }}"
                                                   type="checkbox"
                                                   id="{{ $key.".".$value }}"/>
                                            <label class="form-check-label" for="{{ $key.".".$value  }}"
                                            >{{ $value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            @error('permissions')
                            <span class="alert alert-danger">
                                {{ $message }}
                            </span>
                            @enderror


                            <div class="mt-2 col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-7">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection