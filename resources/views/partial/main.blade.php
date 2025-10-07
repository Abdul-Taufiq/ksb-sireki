@include('partial.header')
@yield('header')
@include('partial.sidebar')


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img/icon_logo.png')}}" alt="ksb" height="60" width="60">
  </div>
  
  
  
    <!-- ISI KONTEN -->
    @yield('konten')


<!-- /.content-wrapper -->
    <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="">TSI-BPR Kusuma Sumbing</a></strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 2.0.0
    </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
  



@yield('footer')
@include('partial.footer')