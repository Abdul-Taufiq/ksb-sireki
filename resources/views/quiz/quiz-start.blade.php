<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Calon Karyawan</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/plugins/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('style.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('template/style.css')}}"> --}}

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">

    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    {{-- logo --}}
    <link rel="shortcut icon" href="{{ asset('img/icon_logo.png') }}">
    <link rel="icon" href="{{ asset('img/icon_logo.png') }}">

    {{-- style for trix editor --}}
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        body {
            background-color: cyan;
        }

        #card {
            max-width: 80%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }

        #img {
            max-width: 80%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 300px;
        }
    </style>


</head>

<body style="background-image:url({{ url('img/bg.jpg') }});">


    <div class="card" id="img">
        <img src="{{ asset('img/logo ksb lengkap.png')}}" alt="icon">
    </div>
    <div class="card" id="card">
        <div class="card card-primary">
            <div class="card-header">
            </div>
            <form id="quickForm" action="  {{ url('test-check') }} " method="post" enctype="multipart/form-data"
                class="p-2">
                {{-- CSRF TOKEN --}}
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <h5>Test Psikolog Calon Karyawan Baru</h5>
                        <hr>
                        <label>Masukan Kode untuk Melanjutkannya:</label>
                        <input type="text" class="form-control" id="start" name="start"
                            value="{{ old('start') }}" required autocomplete="off" placeholder="KODE PENGERJAAN" />
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </div>
            </form>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
        </script>

        <!-- jQuery -->
        <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
        <!-- Select 2 App -->
        <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- File Input -->
        <script src="{{ asset('template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>


        <!-- DataTables  & Plugins -->
        <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <!-- Bootstrap Switch -->
        <script src="{{ asset('template/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
        <script src="{{ asset('template/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
        {{-- toast --}}
        <script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>

        {{-- TABEL 1 --}}
        <script>
            $(document).ready(function() {
                var tabel = $('#tabel1').DataTable({
                    // buttons:  ['copy','excel','colvis'],
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,

                    dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                        "<'row'<'col-md-12'tr>>" +
                        "<'row'<'col-md-3'i><'col-md-7'p>>",

                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, ':visible']
                            }
                        },
                        'colvis'
                    ],

                    lengthMenu: [
                        [5, 10, 20, 50, -1],
                        [5, 10, 20, 50, "Semua"]
                    ]

                });
                tabel.buttons().container()
                    .appendTo('#tabel_wrapper .col-md-6:eq(0)');

            });
        </script>

        {{-- TABEL 2 khusus loker --}}
        <script>
            $(document).ready(function() {
                var tabel = $('#tabel2').DataTable({
                    // buttons:  ['copy','excel','colvis'],
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,

                    dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                        "<'row'<'col-md-12'tr>>" +
                        "<'row'<'col-md-3'i><'col-md-7'p>>",

                    buttons: [

                        'colvis'
                    ],

                    lengthMenu: [
                        [5, 10, 20, 50, -1],
                        [5, 10, 20, 50, "Semua"]
                    ]

                });
                tabel.buttons().container()
                    .appendTo('#tabel_wrapper .col-md-6:eq(0)');

            });
        </script>


        {{-- TABEL 3 khusus pelamar --}}
        <script>
            $(document).ready(function() {
                var tabel = $('#tabel3').DataTable({
                    // buttons:  ['copy','excel','colvis'],
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,

                    dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                        "<'row'<'col-md-12'tr>>" +
                        "<'row'<'col-md-3'i><'col-md-7'p>>",

                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, ':visible']
                            }
                        },
                        'colvis'
                    ],

                    lengthMenu: [
                        [5, 10, 20, 50, -1],
                        [5, 10, 20, 50, "Semua"]
                    ]

                });
                tabel.buttons().container()
                    .appendTo('#tabel_wrapper .col-md-6:eq(0)');

            });
        </script>


        <script>
            function refreshCaptcha() {
                $.ajax({
                    url: "/refereshcapcha",
                    type: 'get',
                    dataType: 'html',
                    success: function(json) {
                        $('.hasil_refereshrecapcha').html(json);
                    },
                    error: function(data) {
                        alert('Try Again.');
                    }
                });
            }
        </script>


        {{-- refresh captcha --}}
        <script>
            function refreshCaptcha() {
                $.ajax({
                    url: "/refereshcapcha",
                    type: 'get',
                    dataType: 'html',
                    success: function(json) {
                        $('.hasil_refereshrecapcha').html(json);
                    },
                    error: function(data) {
                        alert('Try Again.');
                    }
                });
            }
        </script>

        {{-- INPUTAN --}}
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                //Date picker
                $('#date').datetimepicker({
                    format: 'DD-MM-yyyy'
                });
            });
        </script>

        {{-- Toastr --}}
        <script>
            @if (Session::has('status'))
                toastr.error("{{ Session::get('status') }}")
            @endif
        </script>


        {{-- js trix editor --}}
        <script>
            document.addEventListener('trix-file-accept', function(e)) {
                e.preventDefault();
            }
        </script>

</body>

</html>
