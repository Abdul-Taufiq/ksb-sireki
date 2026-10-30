@extends('notloged.main-log')
@section('content')
    <!-- Contact Start -->

    <div class="card-container">
        @if (!$loker->isEmpty())
            @foreach ($loker as $item)
                <div class="card mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <center style="height: 80%">
                        <img src="{{ asset('file_upload/img/' . $item->gambar) }}" alt="loker"
                            style="max-width: 100%; height: 95%;">
                    </center>
                    <h3>{{ $item->posisi }}</h3>
                    <div class="due-date">Pendaftaran Terakhir:</div>
                    <div class="date">{{ $item->tgl_berakhir->translatedFormat('d M Y') }}</div>
                    <button type="button" class="btn btn-konten" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        id="detail_data" data-id="{{ base64_encode($item->id_loker) }}">
                        Lihat selengkapnya
                    </button>
                </div>
            @endforeach
        @else
            <img src="{{ asset('img/no-loker.avif') }}" alt="" style="max-width: 75%">
        @endif
    </div>

    {{ $loker->onEachSide(1)->links('vendor.pagination.bootstrap-5', data: ['scrollTo' => false]) }}
    <!-- Contact End -->


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="frameDetail" type="" width="100%" height="400px"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a id="btnDaftar" type="button" class="btn btn-primary">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        $(document).on("click", "#detail_data", function() {
            var Id = $(this).data("id");
            var modalId = "staticBackdrop" + Id;

            $("#staticBackdrop").attr("id", modalId);
            $("#modalHeader").text("Detail Lowongan Pekerjaan");
            $("#frameDetail").attr("src", "/show-loker/" + Id); //merubah link frame
            $("#btnDaftar").attr("href", "/pelamar/create/" + Id); //merubah link frame

            $("#" + modalId).on("hidden.bs.modal", function() {
                $(this).attr("id", "staticBackdrop");
            });
        });
    </script>
@endsection
@endsection
