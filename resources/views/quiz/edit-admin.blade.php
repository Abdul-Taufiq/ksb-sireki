@extends('partial.main')
@section('konten')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-plus-circle" style="color:green"></i> Edit Test
                            Online</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Edit Test Online</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="  {{ url('test-admin/' . $data->id) }} " method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                                {{-- CSRF TOKEN --}}
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Kode:</label>
                                        <input type="text" class="form-control" id="kode" name="kode"
                                            value="{{ old('start', $data->kode) }}" required />
                                    </div>


                                    <div class="form-group">
                                        <label>Tanggal Mulai:</label>
                                        <input type="datetime-local" class="form-control" id="start" name="start"
                                            value="{{ old('start', $data->start->format('d-m-Y  H:i')) }}" required />
                                    </div>


                                    <div class="form-group">
                                        <label>Tanggal Selesai:</label>
                                        <input type="datetime-local" class="form-control" id="end" name="end"
                                            value="{{ old('start', $data->date->format('d-m-Y  H:i')) }}" required />
                                    </div>



                                    <div class="form-group">
                                        <label for="status">Status :</label>
                                        <select name="status" id="status" autocomplete="off" required
                                            value="{{ old('status', $data->status) }}"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="" disabled selected hidden>- Pilih Status -
                                            </option>
                                            <option value="is_active"
                                                {{ old('status', $data->status) == 'is_active' ? 'selected' : null }}>
                                                is_active</option>
                                            <option value="is_deactive"
                                                {{ old('status', $data->status) == 'is_deactive' ? 'selected' : null }}>
                                                is_deactive</option>
                                        </select>
                                        {{-- Erorr Message --}}
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="terms" class="custom-control-input"
                                                id="exampleCheck1" required>
                                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a
                                                    href="#">terms of service</a>.</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            <br>
                        </div>
                        <div class="card card-outline card-primary">
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <br>
    <br><br><br>
@endsection
