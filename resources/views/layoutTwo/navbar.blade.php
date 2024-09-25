<div class="boxed_wrapper">
    <!-- main header -->
    <header class="main-header style-three custom-header">

        <!-- header-lower -->
        <div class="header-lower custom-header-lower">
            <div class="auto-container">
                <div class="outer-box clearfix">
                    <div class="left-column pull-right">
                        <div class="logo-box custom-header-logo-box">
                            <figure class="logo header-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="img-fluid">
                                </a>
                            </figure>
                        </div>
                        <div class="menu-area">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                                            <a href="{{ route('home') }}">Home</a>
                                        </li>
                                        <li class="{{ request()->routeIs('tournamentCalendar') ? 'current' : '' }}">
                                            <a href="{{ route('tournamentCalendar') }}">Tournaments</a>
                                        </li>
                                        <li class="{{ request()->routeIs('academies') ? 'current' : '' }}">
                                            <a href="{{ route('academies') }}">Academies</a>
                                        </li>
                                        <li class="{{ request()->routeIs('players') ? 'current' : '' }}">
                                            <a href="{{ route('players') }}">Players</a>
                                        </li>
                                        <li class="{{ request()->routeIs('contact') ? 'current' : '' }}">
                                            <a href="{{ route('contact') }}">Contact Us</a>
                                        </li>
                                        <li class="{{ request()->routeIs('contact') ? 'current' : '' }}">
                                            <a href="{{ route('logout') }}">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header custom-sticky-header">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="logo-box header-logo-box">
                        <figure class="logo sticky-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/images/logo_dark.png') }}" alt="Logo" class="img-fluid">
                            </a>
                        </figure>
                    </div>
                    <div class="menu-area">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" style="width: 50px;" alt="Logo"
                        class="img-fluid">
                </a>
            </div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>Chicago 12, Melborne City, USA</li>
                    <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                    <li><a href="mailto:info@example.com">info@example.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->
