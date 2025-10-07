@extends('partial.main')
@section('konten')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Loker</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Data Loker</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              {{-- Table --}}
              <div class="card">
                <div class="card-header">
                  <a class="btn btn-primary btn-icon-split btn-sm mb-2" href="loker/create">
                    <span class="icon text-white-50">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </span>
                    <span class="text">Tambah Data</span>
                  </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tabel2" class="table table-bordered table-striped table-hover" width="100%">
                    <thead style="background-color: lightseagreen">
                    <tr>
                      <th>#</th>
                      <th>Posisi</th>
                      <th>Kualifikasi</th>
                      <th>Tanggal Berakhir</th>
                      <th>Gambar</th>
                      <th style="width: 15%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?> 
                      @foreach ($data as $item)
                    <tr>
                      <td> <?=  $i; ?>  </td>
                      <td> {{ $item -> posisi }} </td>
                      <td> {!! $item->kualifikasi !!} </td>
                      <td> {{ $item -> tgl_berakhir->format('d-M-Y') }} </td>
                      <td> 
                        <img src="{{ asset('file_upload/img/'.$item->gambar) }}" style="width: 50px">
                      </td>
                      {{-- <td> {{ $item -> gambar ?? 'Gambar Tidak Ada'}} </td> --}}
                      <td>
                        {{-- BUTTON UBAH --}}
                          <a class="btn btn-warning btn-icon-split btn-sm mb-2" href="{{ url('loker/'.$item->id_loker.'/edit') }}">
                            <span class="icon text-white-50">
                              <i class="fa fa-edit"></i>
                            </span>
                          </a>
                          <a data-toggle="modal" data-target="#myModal<?php echo $item['id_loker'] ?>"
                            class="btn btn-info btn-icon-split btn-sm mb-2">
                            <span class="icon text-white-50">
                              <i class="fa fa-eye"></i>
                            </span>
                          </a>
                          <form action="{{ url('loker/'.$item->id_loker) }}" method="post" 
                            onsubmit="return confirm('Yakin Hapus Data?')" class="d-inline">
                            {{-- DEKLARASI METHODE ROUTING --}}
                            @method('delete')
                            {{-- CSRF TOKEN --}}
                            @csrf
                            <button class="btn btn-danger btn-icon-split btn-sm mb-2">
                              <span class="icon text-white-50">
                                <i class="fa fa-trash" aria-hidden="true"></i>
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
                      <th>Posisi</th>
                      <th>Kualifikasi</th>
                      <th>Tanggal Berakhir</th>
                      <th>Gambar</th>
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
<div class="modal fade" id="myModal<?php echo $item['id_loker'] ?>" role="dialog" aria-labelledby="exampleModalLabel"
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
              <th>Posisi</th>
              <td> {{ $item -> posisi }} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Kualifikasi</th>
              <td> {!! $item->kualifikasi !!} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Tanggal Berakhir</th>
              <td> {{ $item -> tgl_berakhir->format('d-M-Y')}} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Gambar</th>
                <td> 
                  <img src="{{ asset('file_upload/img/'.$item->gambar) }}" style="width: 50px">
                </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>First Created</th>
              <td> {{ $item -> created_at }} </td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
              <th>Last Update</th>
              <td> {{ $item -> updated_at }} </td>
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