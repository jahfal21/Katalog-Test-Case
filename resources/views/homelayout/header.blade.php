<header class="navbar navbar-light sticky-top flex-md-nowrap p-0">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="#">
        <img src="{{ asset('images/logo_katalog_home.png') }}" alt="Logo" width="150px">
    </a>
    <div class="navbar-nav flex-grow-1 justify-content-center">
        @if (Auth::user()->role_id == 1)
            <div class="nav-item text-center">
                <a class="nav-link {{ request()->is('home/showUser') ? 'active' : '' }}" href="{{ route('home.showUser') }}">
                    <i class="fas fa-users"></i>
                    <span class="ms-2">Manage User</span>
                </a>
            </div>
        @endif
    </div>
    <div class="navbar-nav flex-row ms-auto">
        <div class="nav-item text-nowrap d-flex align-items-center position-relative">
            <div class="order-1">
                <div class="dropdown">
                    <a class="nav-link px-3 dropdown-toggle" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->fullname }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end position-absolute" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('home.profile', Auth::user()->id) }}">Profile</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
