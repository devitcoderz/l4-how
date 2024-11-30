<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('user.dashboard')}}">
            <span class="align-middle">User</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Dashboard
            </li>

            <li class="sidebar-item">
                @if (Session::get('patientS') !== null && Session::has('patientS'))
                    <a class="sidebar-link" href="{{route('user.dashboard.docs', Session::get('patientS')->id)}}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Patient Introduction</span>
                    </a>
                @else
                    <a class="sidebar-link" href="{{route('user.dashboard')}}">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Patient Introduction</span>
                    </a>
                @endif
            </li>

            <li class="sidebar-item">
                @if (Session::get('patientS') !== null && Session::has('patientS'))
                    <a class="sidebar-link" href="{{ route('user.diagnose.patient', Session::get('patientS')->id) }}">
                        <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Diagnostic Summary</span>
                    </a>
                @else
                    <a class="sidebar-link" href="{{ route('user.diagnose') }}">
                        <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Diagnostic Summary</span>
                    </a>
                @endif
            </li>

            <li class="sidebar-item">
                @if (Session::get('patientS') !== null && Session::has('patientS'))
                    <a class="sidebar-link" href="{{ route('user.treatment.patient', Session::get('patientS')->id) }}">
                        <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Treatment Options</span>
                    </a>
                @else
                    <a class="sidebar-link" href="{{ route('user.treatment') }}">
                        <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Treatment Options</span>
                    </a>
                @endif
            </li>

            <li class="sidebar-item">
                @if (Session::get('patientS') !== null && Session::has('patientS'))
                    <a class="sidebar-link" href="{{ route('user.chat.patient.threads.saved', Session::get('patientS')->id) }}">
                        <i class="align-middle" data-feather="save"></i> <span class="align-middle">Saved Chats</span>
                    </a>
                @else
                    <a class="sidebar-link" href="{{ route('user.chat.patient.threads') }}">
                        <i class="align-middle" data-feather="save"></i> <span class="align-middle">Saved Chats</span>
                    </a>
                @endif
            </li>

            <li class="sidebar-header">
                Others
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('user.patients')}}">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Patient Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('user.docs')}}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">Document Management</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
