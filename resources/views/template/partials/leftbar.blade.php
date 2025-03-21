<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="index.html" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset("dist/assets/images/logo.png") }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset("dist/assets/images/logo-sm.png") }}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset("dist/assets/images/logo-dark.png") }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset("dist/assets/images/logo-sm.png") }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user p-3 text-white">
            <a href="" class="d-flex align-items-center text-reset">
                <div class="flex-shrink-0">
                    <img src="{{ asset("dist/assets/images/users/avatar-1.jpg") }}" alt="user-image" height="42"
                        class="rounded-circle shadow">
                </div>
                <div class="flex-grow-1 ms-2">
                    <span class="fw-semibold fs-15 d-block">{{ Auth::user()->name }}</span>
                    <span class="fs-13">{{ Auth::user()->role ?? "User" }}</span>
                </div>
                <div class="ms-auto">
                    <i class="ri-arrow-right-s-fill fs-20"></i>
                </div>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title mt-1"> Main</li>

            <li class="side-nav-item">
                <a href="index.html" class="side-nav-link">
                    <i class="ri-dashboard-2-fill"></i>
                    <span class="badge bg-success float-end">9+</span>
                    <span> Dashboard </span>
                </a>
            </li>

            {{-- Users --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUsers" aria-expanded="false" aria-controls="sidebarUsers"
                    class="side-nav-link">
                    <i class="  ri-shield-user-fill "></i>
                    <span> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUsers">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/simrs/users/index">User</a>
                        </li>
                        <li>
                            <a href="/simrs/roles/index">Role</a>
                        </li>
                        <li>
                            <a href="{{ route("permissions.index") }}">Permission</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- display --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail"
                    class="side-nav-link">
                    <i class=" ri-airplay-fill "></i>
                    <span> Display </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/simrs/display/poli">Poli</a>
                        </li>
                        <li>
                            <a href="/simrs/display/poliws">PoliWS</a>
                        </li>
                        <li>
                            <a href="/simrs/display/pipp">PIPP</a>
                        </li>
                        <li>
                            <a href="/simrs/display/apotek">Apotek</a>
                        </li>
                        <li>
                            <a href="/simrs/anjungan/index">Anjungan</a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- petugas panggil --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#petugasPanggil" aria-expanded="false" aria-controls="petugasPanggil"
                    class="side-nav-link">
                    <i class="  ri-surround-sound-fill  "></i>
                    <span> Petugas Panggil </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="petugasPanggil">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/simrs/petugasPanggil/poliPanggil">Poli</a>
                        </li>
                        <li>
                            <a href="/simrs/petugasPanggil/pipp/pippPanggil">PIPP</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
