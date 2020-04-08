    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg bg-dark" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a href="#" class="navbar-brand">My Smart Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          			<span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="home">
						 	<i class="fa fa-dashboard"></i> Dashboard
						</a>
					</li>
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                           <i class="fa fa-database"></i> Data Management
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                        <a href="#" class="dropdown-item">
                           Users
                        </a>
                        <a href="#" class="dropdown-item">
                           Items
                        </a>
                        </div>
                    </li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="#">
						 	<i class="fa fa-menu"></i> Another Menu
						</a>
					</li> -->
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                           <i class="fa fa-id-badge"></i> Account
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                        <a href="#" class="dropdown-item">
                           Profile
                        </a>
                        <a href="#" class="dropdown-item" onclick="logout()">
                           Logout
                        </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>