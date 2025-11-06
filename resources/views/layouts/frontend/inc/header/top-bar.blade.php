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
                        <a href="javascript:void(0);" onclick="submitDeleteForm()">Logout</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    function submitDeleteForm() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't to Logout!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8c57ff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        })

    }
</script>