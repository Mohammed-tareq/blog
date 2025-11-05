@extends('layouts.frontend.app')

@section('title')
    Contact Us
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Contact Us</li>
@endsection
@section('content')

    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form action="{{route('front.contact.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input
                                            name="name"
                                            type="text"
                                            class="form-control"
                                            placeholder="Your Name"
                                    />
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input
                                            name="email"
                                            type="email"
                                            class="form-control"
                                            placeholder="Your Email"
                                    />
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input
                                            name="phone"
                                            type="text"
                                            class="form-control"
                                            placeholder="Your Phone"
                                    />
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input
                                            name="country"
                                            type="text"
                                            class="form-control"
                                            placeholder="Your Country"
                                    />
                                    @error('country')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input
                                        name="title"
                                        type="text"
                                        class="form-control"
                                        placeholder="Subject"
                                />
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                  <textarea
                          class="form-control"
                          name="message"
                          rows="5"
                          placeholder="Message"
                  ></textarea>
                                @error('message')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <button class="btn" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="contact-info">
                        <h4>
                            <i class="fa fa-map-marker"></i>{{$setting->street}} {{$setting->city}} {{$setting->country}}
                        </h4>
                        <h4><i class="fa fa-envelope"></i>{{$setting->email}}</h4>
                        <h4><i class="fa fa-phone"></i>{{$setting->phone}}</h4>
                        <div class="social">
                            <a href="{{$setting->twitter}}" title="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="{{$setting->facebook}}" title="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{$setting->linkedin}}" title="linkedin"><i class="fab fa-linkedin-in"></i></a>
                            <a href="{{$setting->instagram}}" title="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="{{$setting->youtube}}" title="youtube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection