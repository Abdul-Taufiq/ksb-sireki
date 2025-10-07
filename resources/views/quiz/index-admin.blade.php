@extends('partial.main')
@section('konten')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Jadwal Test</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Jadwal Test</li>
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover" width="100%">
                                    <thead style="background-color: lightseagreen">
                                        <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Tanggal/Jam Mulai</th>
                                            <th>Tanggal/Jam Berakhir</th>
                                            <th>Durasi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td> <?= $i ?> </td>
                                                <td> {{ $item->kode }} </td>
                                                <td> {{ $item->start->format('d-M-Y H:i') }} </td>
                                                <td> {{ $item->date->format('d-M-Y H:i') }} </td>
                                                <td> {{ $diffInMinutes }} Menit</td>
                                                <td> {{ $item->status }} </td>
                                                <td>
                                                    {{-- BUTTON UBAH --}}
                                                    <a class="btn btn-warning btn-icon-split btn-sm mb-2"
                                                        href="{{ url('test-admin/' . $item->id . '/edit') }}">
                                                        <span class="icon text-white-50">
                                                            <i class="fa fa-edit"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                                <?php $i++; ?>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                    <tfoot style="background-color: lightseagreen">
                                        <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Tanggal/Jam Mulai</th>
                                            <th>Tanggal/Jam Berakhir</th>
                                            <th>Durasi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>


                        <h4>Link Test Bisa Diakses disini .</h4>
                        <a href="/test-start" target="_blank"> Buka Disini </a>



                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </div>
    <!-- /.container-fluid -->
    </section>
@endsection
