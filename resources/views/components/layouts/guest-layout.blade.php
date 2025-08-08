<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Bootstrap News Template - Free HTML Templates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Bootstrap News Template - Free HTML Templates" name="keywords" />
    <meta content="Bootstrap News Template - Free HTML Templates" name="description" />

    <!-- Favicon -->
    <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet" />

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />


    <!-- Template Stylesheet -->
    {{--        <link href="../css/style.css" rel="stylesheet" /> --}}
    @vite(['resources/css/app.css', 'resources/lib/slick/slick.css', 'resources/lib/slick/slick-theme.css', 'resources/lib/easing/easing.min.js', 'resources/lib/owlcarousel/owl.carousel.min.js', 'resources/lib/slick/slick.min.js', 'resources/lib/isotope/isotope.pkgd.min.js', 'resources/lib/lightbox/js/lightbox.min.js', 'resources/lib/waypoints/waypoints.min.js', 'resources/lib/counterup/counterup.min.js', 'resources/lib/touchSwipe/jquery.touchSwipe.min.js', 'resources/js/main.js', 'resources/js/app.js'])
</head>

<body>
    <!-- Top Bar Start -->
    @include('components.inc.topBar');
    <!-- Top Bar Start -->

    <!-- Brand Start -->
    @include('components.inc.brand');
    <!-- Brand End -->

    <!-- Nav Bar Start -->
    @include('components.inc.navbar');
    <!-- Nav Bar End -->

    {{ $slot }}

    <!-- Footer Start -->
    @include('components.inc.footer');

    <!-- Footer End -->

   

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>
