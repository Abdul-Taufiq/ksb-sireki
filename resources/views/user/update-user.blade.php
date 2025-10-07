@extends('partial.main')
@section('konten')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="h3 mb-2 text-gray-800"><i class="fa fa-edit" style="color:rgba(216, 216, 40, 0.705)"></i> Update Data Debitur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Update Data Debitur</li>
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
            <div class="card card-warning">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action=" {{ url('user/'.$user->id) }} " method="post" enctype="multipart/form-data">
               {{-- DEKLARASI METHODE ROUTING --}}
                @method('patch')
                {{-- CSRF TOKEN --}}
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap:</label>
                        <input type="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" autocomplete="off"
                            placeholder="Nama Debitur" value="{{ old('nama', $user->nama) }}" required>
                        {{-- Erorr Message --}}
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" autocomplete="off" required maxlength="200" value="{{ old('email', $user->email) }}"
                         class="form-control @error('email') is-invalid @enderror" autofocus>
                        {{-- Erorr Message --}}
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Password</label>
                           <input id="password" type="password" class="form-control form-control-user
                           @error('password') is-invalid @enderror" name="password" 
                           required autocomplete="new-password" placeholder="Password">
   
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                       </div>
                       <div class="col-sm-6">
                           <label>Konfirmasi Password</label>
                           <input id="password-confirm" type="password" 
                           class="form-control form-control-user" name="password_confirmation" 
                           required autocomplete="new-password" placeholder="Konfirmasi Password">
                       </div>
                   </div>
                   <div class="form-group">
                    <label>Hak Akses:</label><br>
                    <select name="level" id="level" autocomplete="off" required value="{{ old('level') }}" class="form-control @error('level') is-invalid @enderror">
                         <option  disabled selected hidden>- Pilih Hak Akses -</option>
                                       <option value="Admin SDM" {{ old('level', $user->level) == "Admin SDM"  ? 'selected' : null }}>Admin SDM</option>
                                       <option value="Admin TSI" {{ old('level',$user->level) == "Admin TSI"  ? 'selected' : null }}>Admin TSI</option>
                               </select>
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


{{-- Menonaktifkan select option --}}
<script>
    const select1 = document.getElementById("level");
    const select2 = document.getElementById("cabang");
  
    select1.addEventListener("change", function() {
      if (this.value === "Admin TSI" || this.value === "Direktur") {
        select2.setAttribute("disabled", "disabled");
      } else {
        select2.removeAttribute("disabled");
      }
    });
  </script>


@endsection