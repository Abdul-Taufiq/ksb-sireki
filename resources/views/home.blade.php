@extends('partial.main')
@section('konten')


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="/home">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $pelamar->count() }}</h3>

                    <p>Semua Data pelamar</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                  </div>
                  <a href="pelamar" class="small-box-footer"
                    >More info <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $lokerActive->count() }}</sup></h3>

                    <p>Data Loker Aktif</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-book" aria-hidden="true"></i>
                  </div>
                  <a href="loker" class="small-box-footer"
                    >More info <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{ $lokerNonactive->count() }}</h3>

                    <p>Data Loker Tidak Aktif</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                  </div>
                  <a href="loker" class="small-box-footer"
                    >More info <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <!-- ./col -->
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ $penjadwalan->count() }}</h3>

                    <p>Semua Data Penjadwalan</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon far fa-calendar-alt"></i>
                  </div>
                  <a href="penjadwalan" class="small-box-footer"
                    >More info <i class="fas fa-arrow-circle-right"></i
                  ></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>




@endsection
