<x-layouts.guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-orange text-black fw-bold">
                        {{ __('Register') }}
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Name & User Name --}}
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="user_name" class="form-label">{{ __('User Name') }}</label>
                                    <input id="user_name" type="text"
                                           class="form-control @error('username') is-invalid @enderror"
                                           name="username" value="{{ old('username') }}">
                                    @error('user_name')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Email & Country --}}
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="country" class="form-label">{{ __('Country') }}</label>
                                    <input id="country" type="text"
                                           class="form-control @error('country') is-invalid @enderror"
                                           name="country" value="{{ old('country') }}">
                                    @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- City & Street --}}
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label for="city" class="form-label">{{ __('City') }}</label>
                                    <input id="city" type="text"
                                           class="form-control @error('city') is-invalid @enderror"
                                           name="city" value="{{ old('city') }}">
                                    @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="street" class="form-label">{{ __('Street') }}</label>
                                    <input id="street" type="text"
                                           class="form-control @error('street') is-invalid @enderror"
                                           name="street" value="{{ old('street') }}">
                                    @error('street')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Image & Phone --}}
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label for="image" class="form-label">{{ __('Image') }}</label>
                                    <input id="image" type="file" name="image"
                                           class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                    <input id="phone" type="text"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Password & Confirm Password --}}
                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm"
                                           class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password"
                                           class="form-control"
                                           name="password_confirmation">
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-person-plus"></i> {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest-layout>