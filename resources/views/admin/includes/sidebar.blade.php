<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
            <span class="align-middle">Admin</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Dashboard
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.dashboard')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Patient Introduction</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.diagnose') }}">
                    <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Diagnostic Summary</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.treatment') }}">
                    <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Treatment Options</span>
                </a>
            </li>

            <li class="sidebar-header">
                Others
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.users')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">User Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.prompts')}}">
                    <i class="align-middle" data-feather="message-circle"></i> <span class="align-middle">Prompt Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.link')}}">
                    <i class="align-middle" data-feather="link"></i> <span class="align-middle">Link Users & Prompts</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.patients')}}">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Patient Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.docs')}}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Document Management</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
