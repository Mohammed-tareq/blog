<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | {{ $title ?? '' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Bootstrap News Template - Free HTML Templates" name="keywords" />
    <meta content="Bootstrap News Template - Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/' . $setting->favicon) }}" alt="Logo">

    @include('components.inc.cssLinks')

    <!-- Template Stylesheet -->

    @vite(['resources/css/app.css', 'resources/lib/slick/slick.css', 'resources/lib/slick/slick-theme.css', 'resources/lib/easing/easing.min.js', 'resources/lib/slick/slick.min.js', 'resources/js/main.js', 'resources/js/app.js'])


</head>

<body>
    <!-- Top Bar Start -->
    @include('components.inc.topBar')
    <!-- Top Bar Start -->

    <!-- Brand Start -->
    @include('components.inc.brand')
    <!-- Brand End -->

    <!-- Nav Bar Start -->
    @include('components.inc.navbar')
    <!-- Nav Bar End -->

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                @section('breadcrumb')

                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                @show
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->


    {{ $slot }}

    <!-- Footer Start -->
    @include('components.inc.footer');

    <!-- Footer End -->


    <!-- JavaScript Libraries -->

    @include('components.inc.jsLinks')
    {{ $script ?? '' }}

</body>

</html>
