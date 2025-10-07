@extends('partial.main')
@section('konten')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pelamar</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Data Pelamar</li>
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
                                <a class="btn btn-primary btn-icon-split btn-sm mb-2" href="pelamar/create">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </span>
                                    {{-- <span class="text">Tambah Data</span> --}}
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tabel3" class="table table-bordered table-striped table-hover" width="100%">
                                    <thead style="background-color: lightseagreen">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pelamar</th>
                                            <th>TTL</th>
                                            <th>Alamat KTP</th>
                                            <th>Email</th>
                                            <th>No Telp</th>
                                            <th>Posisi</th>
                                            <th>Status</th>
                                            <th>Tgl Status</th>
                                            <th style="width: 5%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td> <?= $i ?> </td>
                                                <td> {{ $item->nama }} </td>
                                                <td> {{ $item->tempat_lahir }}, {{ $item->tgl_lahir->format('d-M-Y') }}
                                                </td>
                                                <td> {{ $item->alamat }} </td>
                                                <td> {{ $item->email }} </td>
                                                <td> {{ $item->no_telp }} </td>
                                                <td> {{ $item->posisi }} </td>
                                                <td>
                                                    @if ($item->status == null)
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                                type="button" id="statusDropdown" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                Nothing
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                                                <a class="dropdown-item status" data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop{{ base64_encode($item->id_pelamar) }}">
                                                                    Ubah Status
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        @switch($item->status)
                                                            @case('Sudah Diproses SDM')
                                                                <span class="badge badge-success">{{ $item->status }}</span>
                                                            @break

                                                            @case('Sudah Diterukan ke Cabang')
                                                                <span class="badge badge-info">{{ $item->status }}</span>
                                                            @break

                                                            @case('Tidak Sesuai Kualifikasi')
                                                                <span class="badge badge-danger">{{ $item->status }}</span>
                                                            @break

                                                            @case('Arsip u/ DB Calon Karyawan')
                                                                <span class="badge badge-warning">{{ $item->status }}</span>
                                                            @break
                                                        @endswitch
                                                    @endif
                                                </td>
                                                <td> {{ $item->tgl_status != null ? $item->tgl_status->format('d-m-Y, H:i') : '-' }}
                                                </td>
                                                <td>
                                                    {{-- BUTTON UBAH --}}
                                                    {{-- <a class="btn btn-warning btn-icon-split btn-sm mb-2" href="{{ url('pelamar/'.$item->id_pelamar.'/edit') }}">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-edit"></i>
                                                        </span>
                                                        </a> --}}
                                                    <a data-toggle="modal" data-target="#myModal<?php echo $item['id_pelamar']; ?>"
                                                        class="btn btn-info btn-icon-split btn-sm mb-2">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                    </a>
                                                    <form action="{{ url('pelamar/' . $item->id_pelamar) }}" method="post"
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
                                            <th>Nama Pelamar</th>
                                            <th>TTL</th>
                                            <th>Alamat KTP</th>
                                            <th>Email</th>
                                            <th>No Telp</th>
                                            <th>Posisi</th>
                                            <th>Status</th>
                                            <th>Tgl Status</th>
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
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop{{ base64_encode($item->id_pelamar) }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="quickForm" action="{{ route('status-pelamar') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Status Pelamar
                                <b>{{ $item->nama }}</b>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_pelamar" id="id_pelamar"
                                value="{{ base64_encode($item->id_pelamar) }}">

                            <div class="form-group mb-2">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option disabled selected>-Pilih-</option>
                                    <option value="Sudah Diproses SDM">Sudah Diproses SDM</option>
                                    <option value="Sudah Diterukan ke Cabang">Sudah Diterukan ke Cabang</option>
                                    <option value="Tidak Sesuai Kualifikasi">Tidak Sesuai Kualifikasi</option>
                                    <option value="Arsip u/ DB Calon Karyawan">Arsip u/ DB Calon Karyawan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea name="catatan" id="catatan" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        {{-- modal view --}}
        <div class="modal fade" id="myModal<?php echo $item['id_pelamar']; ?>" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                                <th style="width: 35%">Nama Pelamar</th>
                                <td> {{ $item->nama }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>TTL</th>
                                <td> {{ $item->tempat_lahir }}, {{ $item->tgl_lahir->format('d-M-Y') }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Alamat KTP</th>
                                <td> {{ $item->alamat }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Alamat Domisili</th>
                                <td> {{ $item->domisili }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Jenis Kelamin</th>
                                <td> {{ $item->jns_kelamin }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Email</th>
                                <td> {{ $item->email }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>No Telp</th>
                                <td> {{ $item->no_telp }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>No WhatsApp</th>
                                <td> {{ $item->no_wa }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Posisi</th>
                                <td> {{ $item->posisi }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Pendidikan</th>
                                <td> {{ $item->pendidikan }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Jurusan</th>
                                <td> {{ $item->jurusan ?? 'None' }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Berkas Pendukung</th>
                                <td>
                                    <a href="{{ asset('file_upload/pdf/' . $item->berkas_pendukung) }}" target="_blank"
                                        rel="">{{ $item->berkas_pendukung }}</a>
                                </td>
                                {{-- <td> {{ $item -> cv }} </td> --}}
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Status</th>
                                <td>
                                    @switch($item->status)
                                        @case('Sudah Diproses SDM')
                                            <span class="badge badge-success">{{ $item->status }}</span>
                                        @break

                                        @case('Sudah Diterukan ke Cabang')
                                            <span class="badge badge-info">{{ $item->status }}</span>
                                        @break

                                        @case('Tidak Sesuai Kualifikasi')
                                            <span class="badge badge-danger">{{ $item->status }}</span>
                                        @break

                                        @case('Arsip u/ DB Calon Karyawan')
                                            <span class="badge badge-warning">{{ $item->status }}</span>
                                        @break

                                        @default
                                            -
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Tgl Status</th>
                                <td> {{ $item->tgl_status != null ? $item->tgl_status->format('d-m-Y, H:i') : '-' }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Nama Pemberi Status</th>
                                <td> {{ $item->nama_status }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Catatan Pemberi Status</th>
                                <td> {{ $item->catatan }} </td>
                            </tr>
                            <tr style="border-bottom: 1px solid black;">
                                <th>Terkirim Pada</th>
                                <td> {{ $item->created_at }} </td>
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
