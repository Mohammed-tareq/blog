@extends('layouts.admin.app')

@section('title')
    Contact Show
@endsection

@section('content')

    <!-- Contact Details Card -->
    <div class="card mb-6">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Message from: {{ $contact->name }}</h5>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Back</a>
        </div>

        <div class="card-body mt-5">

            <div class="row mt-1 g-5">

                <!-- Name -->
                <div class="col-md-6 form-control-validation">
                    <div class="form-floating form-floating-outline">
                        <input
                                class="form-control"
                                type="text"
                                id="name"
                                readonly
                                value="{{ $contact->name }}"
                        />
                        <label for="name">Name</label>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input
                                class="form-control"
                                type="text"
                                id="email"
                                readonly
                                value="{{ $contact->email }}"
                        />
                        <label for="email">Email</label>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input
                                type="text"
                                id="phoneNumber"
                                readonly
                                value="{{ $contact->phone }}"
                                class="form-control"
                        />
                        <label for="phoneNumber">Phone Number</label>
                    </div>
                </div>

                <!-- Country -->
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input
                                type="text"
                                class="form-control"
                                readonly
                                id="country"
                                value="{{ $contact->country ?? 'User did not provide a country' }}"
                        />
                        <label for="country">Country</label>
                    </div>
                </div>

                <!-- Subject -->
                <div class="col-md-12">
                    <div class="form-floating form-floating-outline">
                        <input
                                type="text"
                                class="form-control"
                                readonly
                                id="subject"
                                value="{{ $contact->subject ?? 'No subject provided' }}"
                        />
                        <label for="subject">Subject</label>
                    </div>
                </div>

                <!-- Message -->
                <div class="col-md-12">
                    <div class="form-floating form-floating-outline">
                        <textarea
                                id="message"
                                class="form-control"
                                readonly

                                style="height: 150px"
                        >{{ $contact->message }}</textarea>
                        <label for="message">Message</label>
                    </div>
                </div>

            </div>

        </div>
        <div class="card-body d-flex justify-content-center align-items-center gap-6">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject )}}" class="btn btn-primary"> <i
                        class="icon-base ri ri-reply-line icon-18px me-1"></i>Reply</a>
            <a href="{{ route('admin.contacts.destroy',$contact->id) }}" class="btn btn-danger text-white"> <i class="icon-base ri ri-delete-bin-line icon-18px me-1"></i>
                Delete Message
            </a>

        </div>
    </div>
    <!-- /Contact Details Card -->

@endsection
