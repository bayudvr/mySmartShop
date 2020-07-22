    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="./">
                    <strong><i>My Smart Shop</i></strong>
                </a>
            </div>
            <div class="navbar-inner">
            <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @if($menu == 'dashboard') active @endif" href="dashboard">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link @if($menu == 'profile') active @endif" href="profile">
                        <i class="ni ni-single-02 text-yellow"></i>
                        <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($menu == 'master-data') active @endif ?>" href="#" data-toggle="collapse" data-target="#master-data-menu">
                        <i class="ni ni-bullet-list-67 text-default"></i>
                        <span class="nav-link-text">Master Data</span>
                        </a>
                        <ul class="collapse" id="master-data-menu">
                        @if(session('level') == 1)
                            <li class="nav-item list-unstyled">
                            <a href="admin-data" class="nav-link @if($sub_menu == 'admin') active @endif">
                                <i class="ni ni-single-02 text-primary"></i>
                                <span class="nav-link-text">Admin</span>
                            </a>
                            </li>
                        @endif
                        <li class="nav-item list-unstyled">
                            <a href="user-data" class="nav-link @if($sub_menu == 'user') active @endif">
                            <i class="ni ni-single-02 text-yellow"></i>
                            <span class="nav-link-text">User</span>
                            </a>
                        </li>
                        <li class="nav-item list-unstyled">
                            <a href="package-data" class="nav-link @if($sub_menu == 'package') active @endif">
                            <i class="ni ni-archive-2 text-info"></i>
                            <span class="nav-link-text">Packages</span>
                            </a>
                        </li>
                        <li class="nav-item list-unstyled">
                            <a href="payment-method-data" class="nav-link @if($sub_menu == 'payment method') active @endif">
                            <i class="ni ni-credit-card text-success"></i>
                            <span class="nav-link-text">Payment Method</span>
                            </a>
                        </li>
                        </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>