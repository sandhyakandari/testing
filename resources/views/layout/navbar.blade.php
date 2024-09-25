<!-- .preloader -->
<div class="preloader"></div>
<!-- /.preloader -->


<!-- Main Header -->
<header class="main-header custom-main-header">
    <!-- header-bottom -->
    <div class="header-bottom">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 column">
                    <figure class="logo-box">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo.png') }}" width="120" alt="Logo"
                                class="img-fluid">
                        </a>
                    </figure>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 menu-column">
                    <div class="menu-area">
                        <nav class="main-menu navbar-expand-lg">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    {{-- <li class="{{ request()->routeIs('aboutUs') ? 'current' : '' }}">
                                        <a href="{{ route('aboutUs') }}">About Us</a>
                                    </li> --}}
                                    <li class="{{ request()->routeIs('tournamentCalendar') ? 'current' : '' }}">
                                        <a href="{{ route('tournamentCalendar') }}">Tournaments</a>
                                    </li>
                                    <li class="{{ request()->routeIs('academies') ? 'current' : '' }}">
                                        <a href="{{ route('academies') }}">Academies</a>
                                    </li>
                                    <li class="{{ request()->routeIs('players') ? 'current' : '' }}">
                                        <a href="{{ route('players') }}">Players</a>
                                    </li>
                                    {{-- <li class="{{ request()->routeIs('results') ? 'current' : '' }}">
                                        <a href="{{ route('results') }}">Result</a>
                                    </li> --}}
                                    <li class="{{ request()->routeIs('contact') ? 'current' : '' }}">
                                        <a href="{{ route('contact') }}">Contact Us</a>
                                    </li>
                                    <li class="{{ request()->routeIs('getLogin') ? 'current' : '' }} dropdown">
                                        @if (session()->has('role') && session()->has('id'))
                                            <a href="javascript:void()" class="profile-user-academy">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <ul class="user-profile-box">
                                                @if (session()->get('role') == 'Player')
                                                    @php
                                                        $id = session()->get('id');
                                                        $has_data = DB::table('players')
                                                            ->where('id', '=', $id)
                                                            ->first();
                                                    @endphp
                                                    @if ($has_data)
                                                        <li>
                                                            <a href="{{ route('player.dashboard') }}">My Dashboard</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('player.register') }}">Register</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @endif
                                                @elseif (session()->get('role') == 'Academy')
                                                    @php
                                                        $id = session()->get('id');
                                                        $has_data = DB::table('academies')
                                                            ->where('id', '=', $id)
                                                            ->first();
                                                    @endphp
                                                    @if ($has_data)
                                                        <li>
                                                            <a href="{{ route('academy.dashboard') }}"
                                                                class="dashboard-btn">
                                                                My Dashboard
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('academy.register') }}">Register</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @endif
                                                @else
                                                    <li>
                                                        <a href="{{ route('getLogin') }}">Log In</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @else
                                            <a href="{{ route('getLogin') }}">Log In</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="nav-overlay"></div>
        </div>
    </div><!-- header-bottom end -->


    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-lg-1 col-md-12 col-sm-12 column">
                    <figure class="logo-box">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo_dark.png') }}" alt="Logo" class="img-fluid">
                        </a>
                    </figure>
                </div>
                <div class="col-lg-11 col-md-12 col-sm-12 menu-column">
                    <div class="menu-area">
                        <nav class="main-menu navbar-expand-lg">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    {{-- <li class="{{ request()->routeIs('aboutUs') ? 'current' : '' }}">
                                        <a href="{{ route('aboutUs') }}">About Us</a>
                                    </li> --}}
                                    <li class="{{ request()->routeIs('tournamentCalendar') ? 'current' : '' }}">
                                        <a href="{{ route('tournamentCalendar') }}">Tournaments</a>
                                    </li>
                                    <li class="{{ request()->routeIs('academies') ? 'current' : '' }}">
                                        <a href="{{ route('academies') }}">Academies</a>
                                    </li>
                                    <li class="{{ request()->routeIs('players') ? 'current' : '' }}">
                                        <a href="{{ route('players') }}">Players</a>
                                    </li>
                                    {{-- <li class="{{ request()->routeIs('results') ? 'current' : '' }}">
                                        <a href="{{ route('results') }}">Result</a>
                                    </li> --}}
                                    <li class="{{ request()->routeIs('contact') ? 'current' : '' }}">
                                        <a href="{{ route('contact') }}">Contact Us</a>
                                    </li>
                                    <li class="{{ request()->routeIs('getLogin') ? 'current' : '' }} dropdown">
                                        @if (session()->has('role') && session()->has('id'))
                                            <a href="javascript:void()" class="profile-user-academy">
                                                <i class="fa fa-user"></i>
                                            </a>
                                            <ul class="user-profile-box">
                                                @if (session()->get('role') == 'Player')
                                                    @php
                                                        $id = session()->get('id');
                                                        $has_data = DB::table('players')
                                                            ->where('id', '=', $id)
                                                            ->first();
                                                    @endphp
                                                    @if ($has_data)
                                                        <li>
                                                            <a href="{{ route('player.dashboard') }}">My Dashboard</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('player.register') }}">Register</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @endif
                                                @elseif (session()->get('role') == 'Academy')
                                                    @php
                                                        $id = session()->get('id');
                                                        $has_data = DB::table('academies')
                                                            ->where('id', '=', $id)
                                                            ->first();
                                                    @endphp
                                                    @if ($has_data)
                                                        <li>
                                                            <a href="{{ route('academy.dashboard') }}"
                                                                class="dashboard-btn">
                                                                My Dashboard
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('academy.register') }}">Register</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('logout') }}">Logout</a>
                                                        </li>
                                                    @endif
                                                @else
                                                    <li>
                                                        <a href="{{ route('getLogin') }}">Log In</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @else
                                            <a href="{{ route('getLogin') }}">Log In</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sticky-header end -->
</header>
<!-- End Main Header -->

@include('pages.registration')
