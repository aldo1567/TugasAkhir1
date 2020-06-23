<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('karyawan')">
      <a class="nav-link" href="{{route('karyawan.index')}}">
        <i class="fa fa-user" aria-hidden="true"></i>
        <span>Data Karyawan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Nav Item - Jabatan -->
    <li class="nav-item @yield('jabatan')">
      <a class="nav-link" href="{{route('jabatan.index')}}">
        <i class="fas fa-user-tag"></i>
        <span>Jabatan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Jabatan -->
    <li class="nav-item @yield('pendidikan')">
      <a class="nav-link" href="{{route('pendidikan.index')}}">
        <i class="fas fa-graduation-cap"></i>
        <span>Pendidikan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Status -->
    <li class="nav-item @yield('status')">
      <a class="nav-link" href="{{route('status.index')}}">
        <i class="fas fa-award"></i>
        <span>Status</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->