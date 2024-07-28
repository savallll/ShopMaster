<nav class="fh5co-nav" role="navigation">
    <div class="container" style="max-height: 50px">
        <div class="row">
            <div class="col-md-3 col-xs-2">
                <div id="fh5co-logo"><a href="{{ route('client.home') }}">Shop master</a></div>
            </div>
            <div class="col-md-5 col-xs-6 text-center menu-1">
                <ul>
                    {{-- <li class="has-dropdown">
                        <a href="product.html">Shop</a>
                        <ul class="dropdown">
                            <li><a href="single.html">Single Shop</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="about.html">About</a></li>
                    <li class="has-dropdown">
                        <a href="services.html">Services</a>
                        <ul class="dropdown">
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">eCommerce</a></li>
                            <li><a href="#">Branding</a></li>
                            <li><a href="#">API </a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                    @if (!JWTAuth::check())
                        <li><a href="{{ route('auth.index') }}">Sign in</a></li>
                    {{-- @else
                        <li><a href="{{ route('client.business') }}">Business</a></li> --}}
                    @endif
                </ul>
            </div>
            <div class="col-md-4 col-xs-4 text-right hidden-xs menu-2 d-flex align-items-start">
                <ul style="min-height: 100px">
                    <li class="search">
                        <div class="input-group">
                            <form action="{{ route('client.search') }}" method="POST">
                                @csrf
                                <input type="text" placeholder="Search.." style="max-width: 80%" name="key" value="{{ Request::get('key') }}">
                                <span class="input-group-btn">
                                <button class="btn btn-primary pt-3" type="submit"><i class="icon-search"></i></button>
                                </span>
                            </form>
                            
                        </div>
                    </li>
                    <li class="shopping-cart pt-2"><a href="#" class="cart"><span><small>0</small><i class="icon-shopping-cart"></i></span></a></li>
                </ul>
                @if (JWTAuth::check())
                   <ul >
                        <li class="has-dropdown">
                            <a href="#">
                                <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" width="25px" height="25px" alt="" class="user-icon mb-2">
                            </a>

                            <ul class="dropdown" style="width: 200px">
                                <li><a href="{{ route('client.profile.index') }}">Thông tin cá nhân</a></li>
                                <li><a href="{{ route('client.booth',Auth::user()->id ) }}">Booth</a></li>
                                <li><a href="{{ route('client.cart',Auth::user()->id ) }}">Giỏ hàng</a></li>
                                <li><a href="#">Đơn hàng </a></li>
                                <li><a class="" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                                
                            </ul>
                        </li>
                    </ul> 
                @endif
                
            
                {{-- @if (JWTAuth::check()) --}}
                    {{-- <div class="dropdown-center">
                        <a class=" dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >
                            <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" width="25px" height="25px" alt="" class="user-icon mb-2">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/user/{{ Auth::user()->id }}">{{ Auth::user()->name }}</a></li>
                            <li>
                                <a href="" class=" dropdown-item ">
                                    <img src="https://cdn-icons-png.flaticon.com/128/649/649931.png" width="25px" height="25px" alt="" class="cart-icon">Giỏ hàng của bạn
                                </a>
                            </li>
                             <li>
                                <a href="/order/index/{{ Auth::user()->id }}" class=" dropdown-item ">
                                    <img src="https://png.pngtree.com/png-clipart/20230418/original/pngtree-order-confirm-line-icon-png-image_9065104.png" width="25px" height="25px" alt="" class="cart-icon">Đơn hàng hàng của bạn
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div> --}}
                    
                {{-- @endif --}}
            </div>
        </div>
        
    </div>
</nav>
