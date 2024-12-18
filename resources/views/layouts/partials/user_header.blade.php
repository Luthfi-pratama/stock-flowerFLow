<header class="main-header-area">
    <div class="main-header header-transparent header-sticky">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-2 col-xl-2 col-md-6 col-6 col-custom">
                    <div class="header-logo d-flex align-items-center">
                        <a href="{{ route('guest.home') }}">
                            <img class="img-full" src="{{ asset('assets/images/logo/logo-footer.png') }}" alt="Header Logo" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-flex justify-content-center col-custom">
                    <nav class="main-nav d-none d-lg-flex">
                        <ul class="nav">
                            <li><a class="{{ Route::is('guest.home') ? 'active' : '' }}" href="{{ route('guest.home') }}"><span class="menu-text"> Home</span></a></li>
                            <li><a class="{{ Route::is('guest.shop', 'user.cart.*', 'user.transaction.*') ? 'active' : '' }}" href="{{ route('guest.shop') }}"><span class="menu-text">Shop</span></a></li>
                            <li><a class="{{ Route::is('guest.about') ? 'active' : '' }}" href="{{ route('guest.about') }}"><span class="menu-text"> About Us</span></a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2 col-md-6 col-6 col-custom">
                    <div class="header-right-area main-nav">
                        <ul class="nav">
                            <li class="minicart-wrap">
                                <a href="{{ route('user.cart.index') }}" class="minicart-btn toolbar -btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    @unless(Route::is('user.cart.*'))
                                        <span class="cart-item_count">{{ $total ?? 0 }}</span>
                                    @endunless
                                </a>
                            </li>
                            <li class="account-menu-wrap dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <center>{{ Auth::user()->name }}</center>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                            @csrf
                                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i class="fa fa-sign-out-alt"></i>
                                                Logout
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="mobile-menu-btn d-lg-none">
                                <a class="off-canvas-btn" href="#">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>