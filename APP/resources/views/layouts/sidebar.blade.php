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
                            <a class="nav-link @if($menu == 'profile') active @endif ?>" href="profile">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($menu == 'master-data') active @endif" href="#" data-toggle="collapse" data-target="#master-data-menu">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Master Data</span>
                            </a>
                            <ul class="collapse" id="master-data-menu">
                                <li class="nav-item list-unstyled">
                                    <a href="businesses" class="nav-link @if($sub_menu == 'businesses') active @endif">
                                        <i class="ni ni-building text-info"></i>
                                        <span class="nav-link-text">Businesses</span>
                                    </a>
                                </li>
                                <li class="nav-item list-unstyled">
                                    <a href="employees" class="nav-link @if($sub_menu == 'employees') echo @endif">
                                        <i class="ni ni-single-02 text-primary"></i>
                                        <span class="nav-link-text">Employees</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link @if($menu == 'reports') active @endif" data-toggle="collapse" data-target="#report-menu">
                                <i class="ni ni-folder-17 text-success"></i>
                                <span class="nav-link-text">Reports</span>
                            </a>
                            <ul class="collapse" id="report-menu">
                                <li class="nav-item list-unstyled">
                                    <a href="sales" class="nav-link @if($sub_menu == 'sales') active @endif">
                                        <i class="ni ni-books text-default"></i>
                                        <span class="nav-link-text">Sales</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($menu == 'recomendation') active @endif" href="recomendation">
                                <i class="ni ni-notification-70 text-info"></i>
                                <span class="nav-link-text">Recomendation</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($menu == 'subscription') active @endif" href="subscription">
                                <i class="ni ni-credit-card text-yellow"></i>
                                <span class="nav-link-text">Subscription</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>