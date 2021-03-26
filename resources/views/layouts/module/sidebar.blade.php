<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets') }}/img/BPNLangsa.png" width="50" height="50" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">BPN Kota Langsa</div>
    </a>
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Interface
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    @can('isPegawai')
        <li class="nav-item {{ Request::is('attendance-in*', 'attendance-out*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsensi"
                aria-expanded="true" aria-controls="collapseAbsensi">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Menu Absensi</span>
            </a>
            <div id="collapseAbsensi" class="collapse" aria-labelledby="headingAbsensi" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Absensi:</h6>
                    <a class="collapse-item {{ Request::is('attendance-in*') ? 'active' : '' }}" href="{{ route('attendance-in') }}">Absensi Masuk</a>
                    <a class="collapse-item" href="cards.html">Absensi Keluar</a>
                </div>
            </div>
        </li>        
    @endcan

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Menu Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan:</h6>
                @can('isPegawai')
                    <a class="collapse-item" href="buttons.html">Laporan Per Karyawan</a>
                @endcan
                @can('isAdmin')
                    <a class="collapse-item" href="cards.html">Laporan Keseluruhan</a>
                @endcan
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>