@extends('partial.main')
@section('content')
    <div class="app-content">
        <div class="container-fluid mb-2">
            <div class="card py-2 px-3">
                <div class="row">
                    <div class="col-sm-4 text-start mt-sm-1 mt-md-2">
                        <i class="bi bi-alarm" aria-hidden="true"></i>
                        <b id="dateTime"></b><br>
                    </div>
                    <div class="col-sm-8 d-none d-sm-block text-end mt-2">
                        <p>
                            <span id="greeting"></span>
                            <b> {{ auth()->user()->nama }}</b>, Bagaimana Kabarmu Hari ini?
                            😊
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="m-4">
                        <strong># Petunjuk dan Aturan Pengoperasian Aplikasi</strong>
                        <ol>
                            <li>
                                Aplikasi dapat diakses oleh peserta sesuai dengan waktu yang ditunjukan diatas <b>(berwarna
                                    merah)</b>.
                            </li>
                            <li>
                                Apabila waktu yang ditetapkan habis maka peserta akan otomatis <b>keluar dari sitem</b> dan
                                <b>tidak diizinkan login kembali</b>.
                            </li>
                            <li>
                                Disetiap menu aplikasi merupakan kategori soal yang harus dikerjakan oleh peserta.
                            </li>
                            <li>
                                Disetiap <b>kategori soal memiliki waktu pengerjaan</b>, jawaban peserta yang sudah
                                dikerjakan akan tetap tersimpan meskipun peserta belum selesai mengerjakannya.
                            </li>
                            <li>
                                <b>Waktu pengerjaan</b> terhitung ketika peserta berhasil memasukan password tesnya.
                                Password akan diberikan oleh <b>Admin</b>.
                            </li>
                            <li>
                                Jangan memulai tes tanpa arahan dari admin!.
                            </li>
                            <li>
                                Jangan terburu-buru dalam mengambil tindakan, pastikan sudah membaca dan memahami cara
                                pengoperasian aplikasi ini. Jika masih ada yang belum dipahami silahkan tanyakan kepada
                                <b>Admin</b>.
                            </li>
                            <li>
                                <b>Tetap Semangat apapun hasil yang Anda dapatkan.</b>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>


        </div>
        <!--end::Container-->
    </div>
@endsection


@section('script')
    <script>
        function updateDateTime() {
            var dateTimeContainer = document.getElementById('dateTime');
            var greetingContainer = document.getElementById('greeting');

            var currentDate = new Date();
            var currentHour = currentDate.getHours();
            var currentMinute = currentDate.getMinutes();
            var currentSecond = currentDate.getSeconds();

            var formattedTime = padZero(currentHour) + ':' + padZero(currentMinute) + ':' + padZero(currentSecond);
            var formattedDate = currentDate.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            dateTimeContainer.textContent = formattedDate + ' | ' + formattedTime + ' WIB';
            greetingContainer.textContent = getGreeting(currentHour);
        }

        function getGreeting(hour) {
            if (hour >= 0 && hour < 10) {
                return ' Selamat Pagi';
            } else if (hour >= 10 && hour < 14) {
                return ' Selamat Siang';
            } else if (hour >= 14 && hour < 18) {
                return ' Selamat Sore';
            } else {
                return ' Selamat Malam';
            }
        }

        function padZero(number) {
            return (number < 10 ? '0' : '') + number;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
@endsection
