<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link {{ request()->routeIs('client.booth') ? 'active border-bottom' : '' }}" href="{{ route('client.booth',Auth::user()->id) }}">Danh sách sản phẩm</a>
                </li>
                {{-- <li class="has-dropdown">
                    <a href="services.html">Services</a>
                    <ul class="dropdown">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">eCommerce</a></li>
                        <li><a href="#">Branding</a></li>
                        <li><a href="#">API </a></li>
                    </ul>
                </li> --}}
                <li class="nav-item active">
                    <a class="nav-link {{ request()->routeIs('client.booth.create') ? 'active border-bottom' : '' }}" href="{{ route('client.booth.create') }}">Đăng sản phẩm
                        </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.booth.create') ? 'active border-bottom' : '' }}" href="{{ route('client.booth.create') }}">Thông tin gian hàng</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Thay đổi email</a>
                  </li> --}}
            </ul>
        </div>
    </div>
</nav>