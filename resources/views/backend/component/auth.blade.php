<li class="dropdown topbar-item">
    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
        @if(Auth::check())
        <img src="{{ checkMinioImage(Auth::user()->image) }}" alt class="thumb-lg rounded-circle">
        @else
        <img src="" alt class="thumb-lg rounded-circle">
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end py-0">
        <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
            <div class="flex-shrink-0">
                @if(Auth::check())
                <img src="{{ checkMinioImage(Auth::user()->image) }}" alt class="thumb-md rounded-circle">
                @else
                <img src="" alt class="thumb-md rounded-circle">
                @endif
            </div>
            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                <h6 class="my-0 fw-medium text-dark fs-13">{{ Auth::user()->name ?? 'No data available' }}</h6>
                <small class="text-muted mb-0">
                    @if(Auth::check())
                    @if (Auth::user()->role == 'sysadmin')
                    Sysadmin
                    @elseif(Auth::user()->role == 'manager')
                    Manager
                    @endif
                    @else
                    Admin
                    @endif
                </small>
            </div>
            <!--end media-body-->
        </div>
        <div class="dropdown-divider mt-0"></div>
        <small class="text-muted px-2 pb-1 d-block">Account</small>
        <a class="dropdown-item" href=""><i class="las la-user fs-18 me-1 align-text-bottom"></i>
            Profile</a>
        {{-- <a class="dropdown-item" href="pages-faq.html"><i class="las la-wallet fs-18 me-1 align-text-bottom"></i>
            Earning</a> --}}
        <small class="text-muted px-2 py-1 d-block">Settings</small>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="dropdown-item text-danger">
                <i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout
            </button>
        </form>
    </div>
</li>
