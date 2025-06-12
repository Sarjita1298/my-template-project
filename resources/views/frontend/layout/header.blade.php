<header class="header-1-fix">
    <!-- Topbar -->
    <div class="topbar tb-dark tb-md">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="topbar-home2 d-flex justify-content-between align-items-center">
                        <!-- Contact Info -->
                        <div class="tb-contact tb-iconbox">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="{{ url('contact') }}">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span><i>Find us</i> 325 Admiral Unit, North Coast, USA</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="mailto:admin@amwal.com">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <span><i>Email us</i> admin@amwal.com</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="tel:0100123456789">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <span><i>Call us now</i> 0100123456789</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Language & Social -->
                        <div class="tb-social-lan language d-flex align-items-center">
                            <select class="lang form-control me-3" style="width: auto;">
                                <option data-class="usa">English</option>
                                <option data-class="italy">Italian</option>
                                <option data-class="fr">French</option>
                                <option data-class="gm">German</option>
                            </select>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook" title="Facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-twitter" title="Twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus" title="Google+"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play" title="YouTube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="nav-warp nav-warp-h1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Navigation Wrapper -->
                    <div class="navi-warp-home-1 d-flex align-items-center justify-content-between flex-wrap gap-3">

                        <!-- Logo -->
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('frontend/images/Logo-on-dark.png') }}" class="img-responsive" alt="Logo">
                        </a>

                        <!-- Mobile Menu Icon -->
                        <a href="#menu" class="btn-menu-mobile"><i class="fa fa-bars" aria-hidden="true"></i></a>

                        <!-- Navigation Menu -->
                        <nav class="flex-grow-1 ms-4 me-4">
                            <ul class="navi-level-1 active-subcolor list-unstyled mb-0 d-flex flex-wrap">
                                <li><a href="{{ url('home') }}">Home</a></li>
                                <li><a href="#">Company</a>
                                    <ul class="navi-level-2">
                                        <li><a href="#">Company History</a></li>
                                        <li><a href="#">About Us</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Services</a>
                                    <ul class="navi-level-2">
                                        <li><a href="#">Services Page</a></li>
                                        <li><a href="#">Single Service</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Cases</a>
                                    <ul class="navi-level-2">
                                        <li><a href="#">Cases Page</a></li>
                                        <li><a href="#">Single Case</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog">Blogs</a>
                                    <ul class="navi-level-2">
                                        <li><a href="blog">Blog List</a></li>
                                        <li><a href="#">Blog Grid</a></li>
                                        <li><a href="singleblog">Single Blog</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Pages</a>
                                    <ul class="navi-level-2">
                                        <li><a href="#">Our Team</a></li>
                                        <li><a href="#">Testimonials</a></li>
                                        <li><a href="#">Career</a></li>
                                        <li><a href="#">FAQ</a></li>
                                        <li><a href="#">404 Page</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('shop') }}">Shop</a>
                                    <ul class="navi-level-2">
                                        <li>
                                            <a href={{ route('shop') }}><span>Shop Category</span></a>
                                            <ul class="navi-level-3">
                                                <li><a href={{ route('shop') }}><span>Shop Category</span></a></li>
                                                <li><a href={{ route('home') }}><span>Shop Sidebar</span></a></li> {{-- Replace 1 with dynamic ID --}}
                                            </ul>
                                        </li>
                                        <li><a href={{ route('product.single', 1) }}>Shop Single</a></li> {{-- Replace 1 with dynamic ID --}}
                                        <li><a href={{ route('checkout') }}>Checkout Page</a></li>
                                        <li><a href={{ route('cart') }}>Shopping Cart</a></li>
                                    </ul>
                                </li>

                                <li><a href={{ route('contact') }}>Contact</a></li>

                            </ul>
                        </nav>

                        <!-- Header Icons (Right-Aligned) -->
                        <ul class="subnavi list-inline mb-0 d-flex align-items-center">
                            <li class="list-inline-item me-2">
                                <a href="{{ route('your-cart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span id="cart-count">{{ $cartCount ?? 0 }}</span>
                                </a>


                                {{-- <a href="your-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> --}}
                            </li>
                            <li class="list-inline-item position-relative">
                                <a class="btn-search-navi" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                                <div class="search-popup position-absolute end-0 mt-2 p-2" style="z-index: 1000;">
                                    <form class="form-search-navi">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Search Here" type="text">
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>

                    </div> <!-- /navi-warp-home-1 -->
                </div>
            </div>
        </div>
    </div>
</header>
