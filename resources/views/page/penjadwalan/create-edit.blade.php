@extends('partial.main')

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header p-2">
                </div>

                {{-- Form --}}
                <form
                    action="{{ $tipe == 'create' ? route('penjadwalan.store') : route('penjadwalan.update', base64_encode($jadwal->id)) }}"
                    enctype="multipart/form-data" method="POST" id="quickForm">
                    @csrf
                    @if ($tipe != 'create')
                        @method('patch')
                    @endif

                    {{-- card body --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="kegiatan">Kegiatan</label>
                                    <input type="text" name="kegiatan" id="kegiatan"
                                        class="form-control form-control-sm input" required
                                        value="{{ $jadwal->kegiatan ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="tgl_jadwal">Jadwal</label>
                                    <input type="datetime-local" name="tgl_jadwal" id="tgl_jadwal"
                                        class="form-control form-control-sm input" required
                                        value="{{ $jadwal->tgl_jadwal ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label class="wajib" for="keterangan">Keterangan</label>
                                    <textarea required name="keterangan" id="keterangan">{!! $jadwal->keterangan ?? null !!}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 10%">#</th>
                                            <th>Nama Tes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($jadwal != null)
                                            @foreach ($jadwal->jadwalpelamar as $i => $relasi)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                        <input type="hidden" name="id_pivot_{{ $loop->iteration }}"
                                                            id="id_pivot_{{ $loop->iteration }}" value="{{ $relasi->id }}"
                                                            readonly>
                                                        <select name="aksi_{{ $loop->iteration }}"
                                                            id="aksi_{{ $loop->iteration }}" class="wajib border-danger"
                                                            required>
                                                            <option selected disabled>-</option>
                                                            <option value="Edit">🖊️</option>
                                                            <option value="Hapus">🗑️</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select name="id_pelamar_{{ $loop->iteration }}"
                                                                id="id_pelamar_{{ $loop->iteration }}"
                                                                class="form-select form-select-sm input" required>
                                                                <option selected disabled>-Pilih-</option>
                                                                @foreach ($pelamar as $item)
                                                                    <option
                                                                        {{ $relasi->pelamar->id_pelamar == $item->id_pelamar ? 'selected' : '' }}
                                                                        value="{{ $item->id_pelamar }}">
                                                                        [Nama: {{ $item->nama }}] == [TTL:
                                                                        {{ $item->tempat_lahir . ', ' . $item->tgl_lahir->translatedFormat('d F Y') }}]
                                                                        == [Tgl Dikirim:
                                                                        {{ $item->created_at->translatedformat('d F Y, H:i') }}]
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>
                                                    <select name="id_pelamar_1" id="id_pelamar_1"
                                                        class="form-select form-select-sm input" required>
                                                        <option selected disabled>-Pilih-</option>
                                                        @foreach ($pelamar as $item)
                                                            <option value="{{ $item->id_pelamar }}">
                                                                [Nama: {{ $item->nama }}] == [TTL:
                                                                {{ $item->tempat_lahir . ', ' . $item->tgl_lahir->translatedFormat('d F Y') }}]
                                                                == [Tgl Dikirim:
                                                                {{ $item->created_at->translatedformat('d F Y, H:i') }}]
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                    <tbody id="tambahan_data"></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <input class="btn btn-outline-warning w-100" type="button"
                                                    value="(-) Kurangi Data (-)" id="kurangi_data">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">
                                                <input class="btn btn-outline-primary w-100" id="tambah_data" type="button"
                                                    value="(+) Tambah Data (+)">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                    </div>
                    {{-- end card body --}}

                    {{-- card-footer --}}
                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary">Kembali</a>
                        <button id="simpan" type="button" class="btn btn-primary" style="letter-spacing: 2px;">
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                            <i class="bi bi-floppy2"></i><span id="btnText"><b> SIMPAN</b></span>
                        </button>
                    </div>
                    {{-- end card-footer --}}
                </form>
                {{-- end Form --}}
            </div>
            <div class="card card-outline card-danger mb-0"></div>
        </div>
        <!--end::Container-->
    </div>
@endsection


@section('script')
    <script src="{{ asset('script/confirm-button.js') }}"></script>

    <script>
        $(function() {
            $("input").attr("autocomplete", "off");
            // Default semua form diberi border merah
            $(".input").addClass("is-invalid");

            // Event listener untuk semua elemen dengan class .input
            $(document).on("input change", ".input", function() {
                var value = $(this).val();

                if (value && value.toString().trim() !== "") {
                    // Ada value → hijau
                    $(this).addClass("is-valid").removeClass("is-invalid");
                } else {
                    // Kosong → merah
                    $(this).addClass("is-invalid").removeClass("is-valid");
                }
            });

            // Event listener untuk semua elemen dengan class .input
            $(document).on("change keyup", ".wajib", function() {
                var value = $(this).val();

                if (value && value.toString().trim() !== "") {
                    // Ada value → hijau
                    $(this).addClass("border-success").removeClass("border-danger");
                } else {
                    // Kosong → merah
                    $(this).addClass("border-danger").removeClass("border-success");
                }
            });

            // Cek kondisi awal (misalnya form edit sudah ada value)
            $(".input").each(function() {
                var value = $(this).val();
                if (value && value.toString().trim() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            });
        })
        $(document).ready(function() {
            initializeSummernote("#keterangan", "Keterangan...", 100);
        });
    </script>

    <script>
        // tambah data
        document.addEventListener("DOMContentLoaded", function() {
            let container = document.getElementById("tambahan_data");

            container.addEventListener("input", function(event) {
                if (event.target.classList.contains("setRp")) {
                    event.target.value = formatRupiah(event.target.value);
                }
            });

            container.addEventListener("input", function(event) {
                // Jika input tidak kosong, ganti kelas menjadi 'is-valid'
                if (event.target.value.trim() !== "") {
                    event.target.classList.remove("is-invalid");
                    event.target.classList.add("is-valid");
                } else {
                    // Jika input kosong, ganti kelas menjadi 'is-invalid'
                    event.target.classList.remove("is-valid");
                    event.target.classList.add("is-invalid");
                }
            });

            const addBtn = document.getElementById("tambah_data");

            addBtn.addEventListener("click", function() {
                let inputElement = document.querySelectorAll('select[name^="id_pelamar_"]');

                // console.log(inputElement);


                let angka_besar = 0;
                let counter = 0;

                if (inputElement.length > 0) {
                    inputElement.forEach(function(inputEl) {
                        var match = inputEl.name.match(/\d+/);

                        if (match && parseInt(match[0]) > angka_besar) {
                            counter = parseInt(match[0]);
                        }
                    });
                } else {
                    counter = 0;
                }

                // console.log("Nomor Terbesar: " + counter);
                counter++;

                let Options = `
                    <option selected disabled>-Pilih-</option>
                    @foreach ($pelamar as $item)
                        <option value="{{ $item->id_pelamar }}">
                            [Nama: {{ $item->nama }}] == [TTL:
                            {{ $item->tempat_lahir . ', ' . $item->tgl_lahir->translatedFormat('d F Y') }}]
                            == [Tgl Dikirim:
                            {{ $item->created_at->translatedformat('d F Y, H:i') }}]
                        </option>
                    @endforeach
                `;

                if (counter <= 50) {
                    let newTr = document.createElement("tr");

                    let innerHTML = `
                                <td>
                                    ${counter}
                                </td>
                                <td>
                                    <select name="id_pelamar_${counter}" id="id_pelamar_${counter}"
                                        class="form-select form-select-sm input is-invalid" required>
                                        ${Options}
                                    </select>
                                </td>
                    `;

                    newTr.innerHTML = innerHTML;
                    container.appendChild(newTr);
                } else {
                    alert("Melebihi Batas Maximum!");
                }
            });

            // delete
            const delBtn = document.getElementById("kurangi_data");
            delBtn.addEventListener("click", function() {
                let inputElement = document.querySelectorAll('select[name^="id_pelamar_"]');

                let angka_besar = 0;
                let counter = 0;

                if (inputElement.length > 0) {
                    inputElement.forEach(function(inputEl) {
                        var match = inputEl.name.match(/\d+/);
                        if (match && parseInt(match[0]) > angka_besar) {
                            counter = parseInt(match[0]);
                        }
                    });
                } else {
                    counter = 0;
                }

                if (counter <= 1) {
                    alert("Tidak dapat dikurangi!");
                } else {
                    // hapus tr terakhir
                    let lastRow = container.lastElementChild;
                    if (lastRow) {
                        container.removeChild(lastRow);
                        counter--;
                    }
                }
            });
        });
    </script>
@endsection
