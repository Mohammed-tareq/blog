<x-layouts.guest-layout>

     <x-slot name="title">
        Contact-Us
    </x-slot>

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item active"> Countact US</li>

    @endsection

    {{--  handel error   --}}

    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form action="{{route('front.contact.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"/>
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email"/>
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="phone" class="form-control" placeholder="Your Phone"/>
                                    @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Subject"/>
                                @error('title')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" rows="5" placeholder="Message"></textarea>
                                @error('body')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <button class="btn" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p class="mb-4">
                            The contact form is currently inactive. Get a functional and
                            working contact form with Ajax & PHP in a few minutes. Just copy
                            and paste the files, add a little code and you're done.
                        </p>
                        <h4>
                            <i class="fa fa-map-marker"></i>{{$setting->country}} {{$setting->city}} {{$setting->street}}
                        </h4>
                        <h4><i class="fa fa-envelope"></i>{{$setting->email}}</h4>
                        <h4><i class="fa fa-phone"></i>{{$setting->phone}}</h4>
                        <div class="social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

</x-layouts.guest-layout>
