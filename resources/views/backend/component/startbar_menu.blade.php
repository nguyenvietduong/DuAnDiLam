<!--start startbar-menu-->
<div class="startbar-menu">
    <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
        <div class="d-flex align-items-start flex-column w-100">
            <!-- Navigation -->
            <ul class="navbar-nav mb-auto w-100">
                <li class="menu-label pt-0 mt-0">
                    <span>Main Menu</span>
                </li>

                <!-- Admin Dashboard -->
                <li class="nav-item {{ set_active(['admin.dashboard.index']) }}">
                    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                        <i class="fa fa-tachometer menu-icon"></i>
                        <span>Admin Dashboard</span>
                    </a>
                </li>

                {{-- <!-- Account Management -->
                <li class="nav-item {{ set_active(['admin.user.index', 'admin.admin.index']) }}">
                    <a class="nav-link" href="#sidebarAccountManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccountManagement">
                        <i class="fa fa-users menu-icon"></i>
                        <span>Account Management</span>
                    </a>
                    <div class="collapse {{ set_active(['admin.user.index', 'admin.admin.index'], 'show') }}" id="sidebarAccountManagement">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['admin.user.index']) }}" href="">
                                    <i class="fa fa-user menu-icon"></i>
                                    <span>Customer</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active(['admin.admin.index']) }}" href="">
                                    <i class="fa fa-user-tie menu-icon"></i>
                                    <span>Admin</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Category Management -->
                <li class="nav-item {{ set_active(['admin.category.index']) }}">
                    <a class="nav-link" href="">
                        <i class="fa fa-tags menu-icon"></i>
                        <span>Category Management</span>
                    </a>
                </li>

                <!-- Tag Management -->
                <li class="nav-item {{ set_active(['admin.tag.index']) }}">
                    <a class="nav-link" href="">
                        <i class="fa fa-tag menu-icon"></i>
                        <span>Tag Management</span>
                    </a>
                </li> --}}

                <!-- Account Management -->
                <li class="nav-item {{ set_active([]) }}">
                    <a class="nav-link" href="#sidebarSetting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSetting">
                        <i class="fa fa-users menu-icon"></i>
                        <span>Seeting</span>
                    </a>
                    <div class="collapse {{ set_active([], 'show') }}" id="sidebarSetting">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ set_active([]) }}" href="">
                                    <i class="fa fa-user menu-icon"></i>
                                    <span></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ set_active([]) }}" href="">
                                    <i class="fa fa-user-tie menu-icon"></i>
                                    <span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!--end navbar-nav-->
        </div>
        <!--end d-flex-->
    </div>
    <!--end startbar-collapse-->
</div>
<!--end startbar-menu-->
