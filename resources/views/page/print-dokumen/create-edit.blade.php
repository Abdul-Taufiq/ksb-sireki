@extends('partial.main')

@section('style')
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header p-2">
                </div>

                {{-- Form --}}
                <form
                    action="{{ $tipe == 'create' ? route('print-document.store') : route('print-document.update', base64_encode($dokumen->id)) }}"
                    enctype="multipart/form-data" method="POST" id="quickForm">
                    @csrf
                    @if ($tipe != 'create')
                        @method('patch')
                    @endif

                    {{-- card body --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="form-group">
                                    <label for="id_pelamar">Nama Pelamar</label>
                                    <select name="id_pelamar" id="id_pelamar" class="form-select is-valid form-select-sm"
                                        required>
                                        @foreach ($pelamar as $items)
                                            <option {{ $dokumen?->id_pelamar == $items->id_pelamar ? 'selected' : '' }}
                                                value="{{ $items->id_pelamar }}">{{ $items->nama }}
                                                ({{ $items->kode_pelamar }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik"
                                        class="form-control form-control-sm is-valid" placeholder="NIK" required
                                        maxlength="16" value="{{ $dokumen?->pelamar->nik }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                @php
                                    $user = Auth::user();
                                @endphp
                                <div class="form-group">
                                    <label for="id_cabang">Untuk Cabang</label>
                                    @if ($user->id_cabang == 0 || $user->id_cabang == 20)
                                        <select name="id_cabang" id="id_cabang" class="form-select is-valid form-select-sm"
                                            required>
                                            @foreach ($cabang as $items)
                                                <option {{ $dokumen?->id_cabang == $items->id_cabang ? 'selected' : '' }}
                                                    value="{{ $items->id_cabang }}">{{ $items->cabang }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="id_cabang" id="id_cabang" value="{{ $user->id_cabang }}"
                                            class="form-control form-control-sm is-valid" required readonly>
                                        <input type="text" name="cbg" id="cbg"
                                            value="{{ $user->cabang->cabang }}"
                                            class="form-control form-control-sm is-valid" required readonly>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- end card body --}}

                    {{-- card-footer --}}
                    <div class="card-footer text-end">
                        <a href="{{ route('loker.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#id_pelamar').on('change', function() {
                if (this.value.trim() !== '') {
                    $(this).next('.select2').find('.select2-selection')
                        .addClass('is-valid').removeClass('is-invalid');
                } else {
                    $(this).next('.select2').find('.select2-selection')
                        .addClass('is-invalid').removeClass('is-valid');
                }
            });

        });

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

            // Cek kondisi awal (misalnya form edit sudah ada value)
            $(".input").each(function() {
                var value = $(this).val();
                if (value && value.toString().trim() !== "") {
                    $(this).addClass("is-valid").removeClass("is-invalid");
                }
            });
        })
    </script>
@endsection
