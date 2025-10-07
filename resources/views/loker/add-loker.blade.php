@extends('partial.main')
@section('konten')



 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-plus-circle" style="color:green"></i> Tambah Job Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Tambah Job Baru</li>
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
              <form id="quickForm" action="  {{ url('loker') }} " method="post" enctype="multipart/form-data">
                {{-- CSRF TOKEN --}}
				@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="posisi">Posisi:</label>
                    <input type="posisi" name="posisi" class="form-control  @error('posisi') is-invalid @enderror" id="posisi" placeholder="Posisi" 
                        autocomplete="off" value="{{ old('posisi') }}" required maxlength="50">
                    {{-- Erorr Message --}}
                      @error('posisi')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                  {{-- <div class="form-group">
                    <label for="kualifikasi">Kualifikasi:</label>
                    <textarea name="kualifikasi" id="kualifikasi" class="form-control @error('kualifikasi') is-invalid @enderror" rows="3" 
                    placeholder="Kualifikasi" required>{{ old('kualifikasi') }}</textarea>
                    @error('kualifikasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div> --}}
                  <div class="form-group">
                    <label for="kualifikasi">Kualifikasi:</label>
                    <input id="kualifikasi" type="hidden" name="kualifikasi" class="form-control @error('kualifikasi') is-invalid @enderror"
                      placeholder="Kualifikasi" required value="{{ old('kualifikasi') }}">
                    <trix-editor input="kualifikasi"></trix-editor>
                    {{-- Erorr Message --}}
                    @error('kualifikasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Tanggal Berakhir:</label>
                    <div class="input-group date" id="date" data-target-input="nearest">
                        <input readonly type="text" class="form-control datetimepicker-input @error('tgl_berakhir') is-invalid @enderror" data-target="#date" 
                            id="tgl_berakhir" name="tgl_berakhir" autocomplete="off" value="{{ old('tgl_berakhir') }}" required placeholder="DD-MM-YYYY"/>
                        <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                     {{-- Erorr Message --}}
                     @error('tgl_berakhir')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="form-group">
                    <label>Upload Gambar:</label>
                    <input type="file" name="gambar" id="gambar" required class="form-control @error('gambar') is-invalid @enderror">
                    {{-- Erorr Message --}}
                    @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1" required>
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
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


<script>
$('.toastrDefaultError').click(function() {
  toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
});

</script>

@endsection