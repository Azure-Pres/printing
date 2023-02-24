<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{Request::is('admin')?'active':''}}">
            <a class="nav-link" href="{{ url('/admin') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{Request::is('admin/clients*')?'active':''}}">
            <a class="nav-link" href="{{ url('/admin/clients') }}">
                <i class="typcn typcn-user menu-icon"></i>
                <span class="menu-title">Clients</span>
            </a>
        </li>
        <li class="nav-item {{Request::is('admin/users*')?'active':''}}">
            <a class="nav-link" href="{{ url('/admin/users') }}">
                <i class="typcn typcn-user menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
    </ul>
</nav>
