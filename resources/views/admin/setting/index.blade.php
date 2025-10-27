@extends('layouts.admin.app')
@push('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
          integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
@section('title')
    Setting
@endsection

@section('content')
    <div class="row mb-4  gy-6">

        <!-- Merged -->
        <div class="col-xl">
            <div class="card">

                <div class="card-body mt-6">
                    <form action="{{route('admin.setting.update',$setting->id)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
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
                                                name="site_name"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Site Name"
                                                value="{{ $setting->site_name }}"/>
                                        <label for="basic-icon-default-fullname">Site Name</label>
                                    </div>
                                </div>
                                @error('site_name')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-phone2" class="input-group-text"
                          ><i class="icon-base ri ri-phone-fill"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                id="basic-icon-default-phone"
                                                class="form-control phone-mask"
                                                placeholder="Enter Phone"
                                                name="phone"
                                                value="{{ $setting->phone }}"
                                                aria-describedby="basic-icon-default-phone2"/>
                                        <label for="basic-icon-default-phone">Phone No</label>
                                    </div>
                                </div>
                                @error('phone')
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
                                                    value="{{ $setting->email }}"
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
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-earth-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="country"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter  Country"
                                                value="{{ $setting->country }}"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname"> Country</label>
                                    </div>
                                </div>
                                @error('country')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-building-2-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="city"
                                                value="{{ $setting->city }}"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter City"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">City</label>
                                    </div>
                                </div>
                                @error('city')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-road-map-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="street"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Street"
                                                value="{{ $setting->street }}"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Street</label>
                                    </div>
                                </div>
                                @error('street')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-facebook-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="facebook"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Facebook Link"
                                                value="{{ $setting->facebook }}"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Facebook</label>
                                    </div>
                                </div>
                                @error('street')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-instagram-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="instagram"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Instagram Link"
                                                value="{{ $setting->instagram }}"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Instagram</label>
                                    </div>
                                </div>
                                @error('street')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-youtube-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="youtube"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Youtube Link"
                                                value="{{ $setting->youtube }}"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Youtube</label>
                                    </div>
                                </div>
                                @error('youtube')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-twitter-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="twitter"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Twitter Link"
                                                value="{{ $setting->twitter }}"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Twitter</label>
                                    </div>
                                </div>
                                @error('twitter')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-merge mb-6">
                          <span id="basic-icon-default-fullname2" class="input-group-text"
                          ><i class="icon-base ri ri-linkedin-line"></i
                              ></span>
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="linkedin"
                                                id="basic-icon-default-fullname"
                                                placeholder="Enter Linkedin Link"
                                                value="{{ $setting->linkedin }}"
                                                aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2"/>
                                        <label for="basic-icon-default-fullname">Linkedin</label>
                                    </div>
                                </div>
                                @error('linkedin')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-4">
                                    <textarea
                                            class="form-control"
                                            name="desc_for_site"
                                            placeholder="Enter LinkedIn description or link"
                                            rows="5"
                                    >{{  $setting->desc_for_site }}</textarea>
                                @error('desc_for_site')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">

                                <input
                                        type="file"
                                        class="form-control"
                                        name="favicon"
                                        id="dropifyIcon"
                                />
                                @error('favicon')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">


                                <input
                                        type="file"
                                        class="form-control"
                                        name="logo"
                                        id="dropifylogo"
                                />
                                @error('logo')
                                <span class="alert alert-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mt-4 col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-7">Update</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#dropifylogo').dropify({
            messages: {
                'default': 'Drag and drop Logo',
            }
        });
        $('#dropifyIcon').dropify({
            messages: {
                'default': 'Drag and drop Icon',
            }
        });
    </script>
@endpush