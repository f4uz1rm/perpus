<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        {{-- <form class="search-form">
						<div class="input-group">
              <div class="input-group-text">
                <i data-feather="search"></i>
              </div>
							<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
						</div>
					</form> --}}
        <div class="search-form">
            <div class="h5">
                Sistem Informasi Perpustakaan 
            </div>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   {{ Auth::user()->name }}
                       <i class="icon-sm" data-feather="user"></i>
                    {{-- <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile"> --}}
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        {{-- <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80"
                                alt="">
                        </div> --}}
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('profile.edit') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li class="dropdown-item py-2">
                                <a type="submit" href="#"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();"
                                    class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>
                        </form>

                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
