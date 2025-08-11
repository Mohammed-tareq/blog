<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{ route('front.home') }}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
                            @foreach ($categories as $category)
                                <a href="{{ route('front.category.posts', $category->slug) }}"
                                    title="{{ $category->name }}" class="dropdown-item">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="single-page.html" class="nav-item nav-link">Single Page</a>
                    <a href="dashboard.html" class="nav-item nav-link">Dashboard</a>
                    <a href="{{ route('front.contact') }}" class="nav-item nav-link">Contact Us</a>
                </div>
                <div class="social ml-auto">
                    <a href="{{ $setting->twitter }}"title="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $setting->facebook }}"title="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $setting->instagram }}"title="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $setting->youtube }}"title="youtube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
