@extends('partial.main')
@section('konten')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Data User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     {{-- PEMBERITAHUAN DATA BERHASIL/TIDAK DITAMBAH --}}
     @if (session('status'))
     <div class="alert alert-success">
       {{ session('status') }}
     </div>
     @endif


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              {{-- Table --}}
              <div class="card">
                <div class="card-header">
                  <a class="btn btn-primary btn-icon-split btn-sm mb-2" href="/register">
                    <span class="icon text-white-50">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </span>
                    <span class="text">Tambah Data</span>
                  </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tabel1" class="table table-bordered table-striped table-hover" width="400px">
                    <thead style="background-color: lightseagreen; width: 100%">
                    <tr>
                      <th style="width: 5%">#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Hak Akses</th>
                      <th style="width: 20%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?> 
                      @foreach ($data as $item)
                    <tr>
                      <td> <?=  $i; ?>  </td>
                      <td> {{ $item -> nama }} </td>
                      <td> {{ $item -> email }} </td>
                      <td> {{ $item -> level }} </td>
                      <td>
                        {{-- BUTTON UBAH --}}
                          <a class="btn btn-warning btn-icon-split btn-sm mb-2" href="{{ url('user/'.$item->id.'/edit') }}">
                            <span class="icon text-white-50">
                              <i class="fa fa-edit"></i>
                            </span>
                            <span class="text">Edit</span>
                          </a>

                          <a data-toggle="modal" data-target="#myModal<?php echo $item['id'] ?>"
                            class="btn btn-info btn-icon-split btn-sm mb-2">
                            <span class="icon text-white-50">
                              <i class="fa fa-eye"></i>
                            </span>
                            <span class="text" style="color: black">Detail</span>
                          </a>

                          <form action="{{ url('user/'.$item->id) }}" method="post" onsubmit="return confirm('Yakin Hapus Data?')" class="d-inline">
                            {{-- DEKLARASI METHODE ROUTING --}}
                            @method('delete')
                            {{-- CSRF TOKEN --}}
                            @csrf
                            <button class="btn btn-danger btn-icon-split btn-sm mb-2" style="width: 35px; height: 35px">
                                <span class="icon text-white-50">
                                    <i class="fa fa-trash"></i>
                                  </span>
                            </button>
                        </form>
                         
                      </td>
                      <?php $i++; ?>
                      @endforeach     
                    </tr>
                    </tbody>
                    <tfoot style="background-color: lightseagreen">
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Hak Akses</th>
                      <th>Aksi</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      {{-- TABEL ON MODAL --}}
@foreach ($data as $item)
<div class="modal fade" id="myModal<?php echo $item['id'] ?>" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
          
          <table style="width: 100%; ">
            <tr style="border-bottom: 1px solid black;">
              <th>Nama</th>
              <td>{{ $item -> nama }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Email</th>
              <td>{{ $item -> email }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Hak Akses</th>
              <td>{{ $item -> level }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Password</th>
              <td style="font-size: 12px">{{ $item -> password }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Tanggal Dibuat</th>
              <td>{{ $item -> created_at }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Terakhir Di Edit</th>
              <td>{{ $item -> updated_at }}</td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
        </div>
    </div>
</div>
</div>
@endforeach   

@endsection

