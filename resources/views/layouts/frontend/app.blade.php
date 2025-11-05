<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ config('app.name')  }} | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta
            content="@yield('keywords')"
            name="keywords"
    />
    <meta
            content="@yield('description')"
            name="description"
    />
    <link rel="canonical" href="{{ url()->full() }}">
    <meta name="robots" content="index, follow">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon"/>

    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap"
            rel="stylesheet"
    />

    <!-- CSS Libraries -->
    <link
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            rel="stylesheet"
    />
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <link rel="stylesheet" href="{{ asset('assets/front/lib/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/lib/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/vendor/front/file-input/css/fileinput.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
    @stack('css')
</head>

<body>

<!-- Top Bar Start -->
@include('layouts.frontend.inc.header.index')

@unless(View::hasSection('breadcrumb-hide'))
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap mb-3">
        <div class="container">
            <ul class="breadcrumb">
                @section('breadcrumb')
                    <li class="breadcrumb-item"><a href="{{route('front.index')}}">Home</a></li>
                @show
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
@endunless

@yield('content')





<!-- Footer Start -->
@include('layouts.frontend.inc.footer.index')


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>--}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script>
    @auth
    let role = "user";
    let id = {{auth()->user()->id}};
    let route = "{{route('front.dashboard.profile.notification.deleteAll')}}";
    @endauth

</script>

<script src="{{asset('assets/front/vendor/front/file-input/js/fileinput.min.js')}}"></script>
<script src="{{asset('assets/front/vendor/front/file-input/themes/fa5/theme.min.js')}}"></script>
<script src="{{asset('assets/front/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('assets/front/lib/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/front/js/main.js')}}"></script>
<script src="{{asset('/build/assets/app-BiS2zVJo.js')}}"></script>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

@stack('js')
</body>
</html>
