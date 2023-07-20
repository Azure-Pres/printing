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
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/batches') }}">
                <i class="typcn typcn-chart-pie menu-icon"></i>
                <span class="menu-title">Batches</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/codes') }}">
                <i class="typcn typcn-chart-pie menu-icon"></i>
                <span class="menu-title">Codes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/templates') }}">
                <i class="typcn typcn-chart-pie menu-icon"></i>
                <span class="menu-title">Templates</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/job-cards') }}">
                <i class="typcn typcn-chart-pie menu-icon"></i>
                <span class="menu-title">Job Cards</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/client-uploads') }}">
                <i class="typcn typcn-chart-pie menu-icon"></i>
                <span class="menu-title">Client Uploads</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/user-logs') }}">
                <i class="typcn typcn-chart-pie menu-icon"></i>
                <span class="menu-title">User Logs</span>
            </a>
        </li>
    </ul>
</nav>
