<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- <li class="nav-item {{Request::is('client')?'active':''}}">
            <a class="nav-link" href="{{ url('/client') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li> --}}
        <li class="nav-item {{Request::is('client/upload-data')?'active':''}}">
            <a class="nav-link" href="{{ url('/client/upload-data') }}">
                <i class="typcn typcn-upload menu-icon"></i>
                <span class="menu-title">Upload Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/client/codes') }}">
                <i class="typcn typcn-chart-pie menu-icon"></i>
                <span class="menu-title">Codes</span>
            </a>
        </li>
    </ul>
</nav>
