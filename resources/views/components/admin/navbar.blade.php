<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="{{ url('/admin') }}"><img
                    src="{{ asset('assets/images/logo.png') }}" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('/admin') }}"><img
                    src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                data-toggle="minimize">
                <span class="typcn typcn-th-menu"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="profile" />
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                    aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ url('logout') }}">
                        <i class="typcn typcn-eject text-primary"></i>
                        Logout
                    </a>
                    <a class="dropdown-item" href="{{ url('admin/profile/update')}}">
                        <i class="typcn typcn-eject text-primary"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ url('admin/change-password') }}">
                        <i class="typcn typcn-eject text-primary"></i>
                        Change Password
                    </a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-date dropdown">
                <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                    <h6 class="date mb-0">Today : {{ date('M d') }}</h6>
                    <i class="typcn typcn-calendar"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>
