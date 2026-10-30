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
            <!--begin::Card-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Starter Card</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"
                            aria-label="Collapse card">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" aria-label="Remove card">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">Start creating your amazing application!</div>
                <!-- /.card-body -->
                <div class="card-footer">The footer of the card</div>
                <!-- /.card-footer -->
            </div>
            <!--end::Card-->

            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <!--begin::Card-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Starter Card</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"
                                    aria-label="Collapse card">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"
                                    aria-label="Remove card">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            vvvv
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">The footer of the card</div>
                        <!-- /.card-footer -->
                    </div>
                    <!--end::Card-->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
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
