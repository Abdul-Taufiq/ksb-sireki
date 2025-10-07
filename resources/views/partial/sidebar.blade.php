<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      {{-- fullscreen --}}
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

       <!-- Nav Item - User Information -->
       <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
            <img class="img-profile rounded-circle"
                src="{{ asset('template/dist/img/avatar5.png')}}" style="width: 35px">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="{{ asset('img/logo ksb lengkap.png')}}" alt="Logo" class="brand-image" >
      <span class="brand-text font-weight-light"> &nbsp; </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('template/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->nama }} </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{ request() -> is('/home') ? 'menu-open' : ''}}">
            <a href="/home" class="nav-link {{ request() -> is('/home') ? 'active aria-expanded= "true"' : 'collapsed'}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          



{{-- hak AKSES Admin SDM --}}
@if (auth()->user()->level=="Admin SDM")

          <li class="nav-item {{ request() -> is('loker*') ? 'active menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link  {{ request() -> is('loker*') ? 'active aria-expanded= "true"' : 'collapsed'}}">
              <i class="nav-icon fa fa-book" aria-hidden="true"></i>
              <p>
                Data Loker
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  {{ request() -> is('loker*') ? 'style="display: block;"' : '' }}">
              <li class="nav-item">
                <a href="/loker" class="nav-link {{ Request::is('loker') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tampilkan Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/loker/create" class="nav-link {{ Request::is('loker/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print</p>
                </a>
              </li> --}}
            </ul>
          </li>

          <li class="nav-item {{ request() -> is('pelamar*') ? 'active menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link  {{ request() -> is('pelamar*') ? 'active aria-expanded= "true"' : 'collapsed'}}">
              <i class="nav-icon fa fa-users" aria-hidden="true"></i>
              <p>
                Data Pelamar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  {{ request() -> is('pelamar*') ? 'style="display: block;"' : '' }}">
              <li class="nav-item">
                <a href="/pelamar" class="nav-link {{ Request::is('pelamar') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tampilkan Data</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="/pelamar/create" class="nav-link {{ Request::is('pelamar/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <li
            class="nav-item {{ request()->is('penjadwalan*', 'test-admin*') ? 'active menu-is-opening menu-open' : '' }}">
            <a href="#"
                class="nav-link  {{ request()->is('penjadwalan*', 'test-admin*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Data Penjadwalan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul
                class="nav nav-treeview  {{ request()->is('penjadwalan*') ? 'style="display: block;"' : '' }}">
                <li class="nav-item">
                    <a href="/penjadwalan"
                        class="nav-link {{ Request::is('penjadwalan') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Test Offline</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/test-admin"
                        class="nav-link {{ Request::is('test-admin*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Test Online</p>
                    </a>
                </li>
            </ul>
        </li>


{{-- HAK AKSES ADMIN TSI --}}
@elseif (auth()->user()->level=="Admin TSI")          

          <li class="nav-item {{ request() -> is('loker*') ? 'active menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link  {{ request() -> is('loker*') ? 'active aria-expanded= "true"' : 'collapsed'}}">
              <i class="nav-icon fa fa-book" aria-hidden="true"></i>
              <p>
                Data Loker
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  {{ request() -> is('loker*') ? 'style="display: block;"' : '' }}">
              <li class="nav-item">
                <a href="/loker" class="nav-link {{ Request::is('loker') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tampilkan Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/loker/create" class="nav-link {{ Request::is('loker/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print</p>
                </a>
              </li> --}}
            </ul>
          </li>

          <li class="nav-item {{ request() -> is('pelamar*') ? 'active menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link  {{ request() -> is('pelamar*') ? 'active aria-expanded= "true"' : 'collapsed'}}">
              <i class="nav-icon fa fa-users" aria-hidden="true"></i>
              <p>
                Data Pelamar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  {{ request() -> is('pelamar*') ? 'style="display: block;"' : '' }}">
              <li class="nav-item">
                <a href="/pelamar" class="nav-link {{ Request::is('pelamar') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tampilkan Data</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="/pelamar/create" class="nav-link {{ Request::is('pelamar/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Data</p>
                </a>
              </li> --}}
            </ul>
          </li>

          <li
            class="nav-item {{ request()->is('penjadwalan*', 'test-admin*') ? 'active menu-is-opening menu-open' : '' }}">
            <a href="#"
                class="nav-link  {{ request()->is('penjadwalan*', 'test-admin*') ? 'active aria-expanded= "true"' : 'collapsed' }}">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    Data Penjadwalan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul
                class="nav nav-treeview  {{ request()->is('penjadwalan*') ? 'style="display: block;"' : '' }}">
                <li class="nav-item">
                    <a href="/penjadwalan"
                        class="nav-link {{ Request::is('penjadwalan') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Test Offline</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/test-admin"
                        class="nav-link {{ Request::is('test-admin*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Test Online</p>
                    </a>
                </li>
            </ul>
        </li>

          

          <li class="nav-item {{ request() -> is('user*') ? 'active menu-is-opening menu-open' : ''}}">
            <a href="#" class="nav-link  {{ request() -> is('user*') ? 'active aria-expanded= "true"' : 'collapsed'}}">
              <i class="nav-icon fa fa-lock" aria-hidden="true"></i>
              <p>
                Data User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  {{ request() -> is('user*') ? 'style="display: block;"' : '' }}">
              <li class="nav-item">
                <a href="/user" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tampilkan Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/register" class="nav-link {{ Request::is('register*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registerkan User</p>
                </a>
              </li>
            </ul>
          </li>
@endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Yakin Keluar?</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body">Pilih "Logout" Jika Anda Yakin Akan Keluar.</div>
         <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
               @csrf
                 <button type="submit" class="btn btn-primary">Logout</button>
                 
             </form>
         </div>
     </div>
 </div>
</div>