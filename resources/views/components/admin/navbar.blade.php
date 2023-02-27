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
                    <a class="dropdown-item" href="{{ url('admin/profile/update/'.encrypt(Auth::user()->id))}}">
                        <i class="typcn typcn-eject text-primary"></i>
                        Profile
                    </a>
{{--                     <a class="dropdown-item" href="{{ url('change-password') }}">
                        <i class="typcn typcn-eject text-primary"></i>
                        Change Password
                    </a> --}}
                </div>
            </li>
            {{-- <li class="nav-item nav-user-status dropdown">
                <p class="mb-0">Last login was 23 hours ago.</p>
            </li> --}}
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-date dropdown">
                <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                    <h6 class="date mb-0">Today : {{ date('M d') }}</h6>
                    <i class="typcn typcn-calendar"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                    id="messageDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-cog-outline mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="messageDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                    {{-- <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image"
                                class="profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow">
                            <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                            </h6>
                            <p class="font-weight-light small-text text-muted mb-0">
                                The meeting is cancelled
                            </p>
                        </div>
                    </a> --}}
                </div>
            </li>
            <li class="nav-item dropdown mr-0">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                    id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-bell mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    {{-- <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="typcn typcn-info mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Application Error</h6>
                            <p class="font-weight-light small-text mb-0 text-muted">
                                Just now
                            </p>
                        </div>
                    </a> --}}
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>

<nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
    <div class="navbar-links-wrapper d-flex align-items-stretch">
        <div class="nav-link">
            <a href="javascript:;"><i class="typcn typcn-calendar-outline"></i></a>
        </div>
        <div class="nav-link">
            <a href="javascript:;"><i class="typcn typcn-mail"></i></a>
        </div>
        <div class="nav-link">
            <a href="javascript:;"><i class="typcn typcn-folder"></i></a>
        </div>
        <div class="nav-link">
            <a href="javascript:;"><i class="typcn typcn-document-text"></i></a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item ml-0">
                <h4 class="mb-0">Dashboard</h4>
            </li>
            <li class="nav-item">
                <div class="d-flex align-items-baseline">
                    <p class="mb-0">Home</p>
                    <i class="typcn typcn-chevron-right"></i>
                    <p class="mb-0">Main Dahboard</p>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-search d-none d-md-block mr-0">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." aria-label="search"
                        aria-describedby="search">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="search">
                            <i class="typcn typcn-zoom"></i>
                        </span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
