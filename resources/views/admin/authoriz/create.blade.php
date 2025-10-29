@extends('layouts.admin.app')

@section('title')
    Users Create
@endsection

@section('content')
    <div class="row mb-6 gy-6">

        <!-- Merged -->
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Admin</h5>

                        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">Back</a>

                </div>
                <div class="card-body">
                    <form action="{{route('admin.admins.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-role-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="role"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Name"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Role Name</label>
                                    </div>
                                </div>
                                @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <h3><b>Post Permission</b></h3>
                            </div>
                          <div class="col-md-12 d-flex justify-content-evenly gap-3">

                              <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="create" />
                                  <label class="form-check-label" for="create"
                                  >Create Post</label
                                  >
                              </div>
                              <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="read"/>
                                  <label class="form-check-label" for="read"
                                  >Read Post</label
                                  >
                              </div>
                              <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="update"/>
                                  <label class="form-check-label" for="update"
                                  >Update Post</label
                                  >
                              </div>
                              <div class="form-check form-switch mb-2">
                                  <input class="form-check-input" type="checkbox" id="delete"/>
                                  <label class="form-check-label" for="delete"
                                  >Delete Post</label
                                  >
                              </div>
                          </div>


                            <div class="mt-2 col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-7">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection