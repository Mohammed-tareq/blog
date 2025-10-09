<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Bootstrap News Template - Free HTML Templates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
            content="Bootstrap News Template - Free HTML Templates"
            name="keywords"
    />
    <meta
            content="Bootstrap News Template - Free HTML Templates"
            name="description"
    />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

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
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
            rel="stylesheet"
    />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<!-- Top Bar Start -->
@include('layouts.frontend.inc.header.index');


@yield('content')





<!-- Footer Start -->
@include('layouts.frontend.inc.footer.index')


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>
