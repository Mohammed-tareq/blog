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
                <div class=" tb-menu ">
                    @guest
                        <a href="{{ route('register') }}">Register</a>
                        <a href="{{ route('login') }}">Login</a>
                    @endguest
                        @auth
                            <!-- Logout Link -->
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                                Log Out
                            </a>
                        @endauth

                        <!-- Hidden Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>

                        <!-- Bootstrap 4 Confirmation Modal -->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to log out?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="document.getElementById('logout-form').submit();">Yes, Log Out</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar Start -->
