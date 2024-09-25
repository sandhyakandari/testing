<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin_asset/dist/img/logo.jpeg') }}" alt="Kheldhaara Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kheldhaara</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin_asset/dist/img/logo.jpeg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Kheldhaara</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.adminDashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.adminDashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.playerList') }}"
                        class="nav-link {{ request()->routeIs('admin.playerList') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Players
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.academyList') }}"
                        class="nav-link {{ request()->routeIs('admin.academyList') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Academies
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.rankList') }}"
                        class="nav-link {{ request()->routeIs('admin.rankList') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Ranking
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tournamentsList') }}"
                        class="nav-link {{ request()->routeIs('admin.tournamentsList') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Tournaments
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.Banner') }}"
                        class="nav-link {{ request()->routeIs('admin.Banner') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Add Banner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.adminLogOut') }}" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
