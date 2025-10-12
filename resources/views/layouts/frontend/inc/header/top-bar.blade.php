<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>{{ $setting->email }}</p>
                    <p><i class="fas fa-phone-alt"></i>{{ $setting->phone }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">
                    @guest
                        <a href="{{route('login')}}">Login</a>
                        <a href="{{route('register')}}">Register</a>
                    @endguest

                    @auth
                        <a href="javascript:void(0);" onclick="if(confirm('Are You Sure You Want To Logout')){
                    document.getElementById('logoutForm').submit();
                    } return false ">Logout</a>
                    @endauth
                    <form id="logoutForm" action="{{route('logout')}}" method="post">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar Start -->