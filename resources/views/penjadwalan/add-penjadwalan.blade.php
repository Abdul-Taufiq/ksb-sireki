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
              <li class="breadcrumb-item active">Tambah Penjadwalan Baru</li>
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
              <form id="quickForm" action="  {{ url('penjadwalan') }} " method="post" enctype="multipart/form-data">
                {{-- CSRF TOKEN --}}
				@csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_pelamar">Nama Pelamar :</label>
                        <select name="id_pelamar" id="id_pelamar" autocomplete="off" required value="{{ old('id_pelamar') }}" class="form-control select2 select2-danger @error('id_pelamar') is-invalid @enderror">
                            <option value="" disabled selected hidden>- Pilih Pelamar -</option>
                            @foreach ($pelamar as $item)
                            <option value="{{ $item->id_pelamar }}"  {{ old('id_pelamar') == $item->id_pelamar ? 'selected' : null }}>
                               Nama: {{ $item->nama }} | Posisi: {{ $item->posisi }} | Email: {{ $item->email }} | No Telp: {{ $item->no_telp }}
                            </option>
                            @endforeach 
                        </select>
                        {{-- Erorr Message --}}
                        @error('id_pelamar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_loker"> Posisi Yang Dilamar :</label>
                        <select name="id_loker" id="id_loker" autocomplete="off" required value="{{ old('id_loker') }}" class="form-control select2 select2-danger @error('id_loker') is-invalid @enderror">
                            <option value="" disabled selected hidden>- Pilih Posisi -</option>
                            @foreach ($loker as $item)
                            <option value="{{ $item->id_loker }}"  {{ old('id_loker') == $item->id_loker ? 'selected' : null }}>
                               Posisi: {{ $item->posisi }} | Tanggal Dibuart: {{ $item->created_at }}
                            </option>
                            @endforeach 
                        </select>
                        {{-- Erorr Message --}}
                        @error('id_loker')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tanggal Test:</label>
                        <div class="input-group date" id="date" data-target-input="nearest">
                            <input readonly type="text" class="form-control datetimepicker-input @error('tgl_test') is-invalid @enderror" data-target="#date" 
                                id="tgl_test" name="tgl_test" autocomplete="off" value="{{ old('tgl_test') }}" required placeholder="DD-MM-YYYY"/>
                            <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                         {{-- Erorr Message --}}
                         @error('tgl_test')
                         <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                    </div>
                    <div class="form-group">
                        <label>Jam Test:</label>
                        <input type="time" name="jam" id="jam" class="form-control @error('jam') is-invalid @enderror" rows="3" 
                            placeholder="Jam Test" required value="{{ old('jam') }}"></input>
                            {{-- Erorr Message --}}
                            @error('jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    
                  <div class="form-group">
                    <label for="keterangan">Keterangan Test:</label>
                    <input type="keterangan" name="keterangan" class="form-control  @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Keterangan" 
                        autocomplete="off" value="{{ old('keterangan') }}" required maxlength="50">
                    {{-- Erorr Message --}}
                      @error('keterangan')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                  <div class="form-group">
                    <label for="tempat">Tempat Test:</label>
                    <textarea name="tempat" id="tempat" class="form-control @error('tempat') is-invalid @enderror" rows="3" 
                    placeholder="tempat" required>{{ old('Tempat') }}</textarea>
                    {{-- Erorr Message --}}
                    @error('tempat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pic">Nama PIC:</label>
                    <input name="pic" id="pic" class="form-control @error('pic') is-invalid @enderror" rows="3" 
                    placeholder="Nama PIC" required value="{{ old('pic') }}"></input>
                    {{-- Erorr Message --}}
                    @error('pic')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="pic_telp">No Telp PIC:</label>
                    <input name="pic_telp" id="pic_telp" class="form-control @error('pic_telp') is-invalid @enderror" rows="3" 
                    placeholder="No Telp PIC" required value="{{ old('pic_telp') }}" maxlength="14"></input>
                    {{-- Erorr Message --}}
                    @error('pic_telp')
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