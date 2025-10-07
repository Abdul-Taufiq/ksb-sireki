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
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            // "responsive": true,
            "scrollX": true,

            "dom": "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-3'i><'col-md-7'p>>",

            "buttons": [{
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
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    customize: function(doc) {
                        var tableBody = doc.content[1].table.body;
                        tableBody.forEach(function(row) {
                            row.forEach(function(cell, index) {
                                if (cell.text === null || cell.text === "") {
                                    cell.text = "Nothing";
                                }
                            });
                        });
                    }


                },
                'colvis'
            ],

            "lengthMenu": [
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

        //Date picker
        $('#date').datetimepicker({
            format: 'DD-MM-yyyy'
        });
    });
</script>

{{-- Toastr --}}
<script>
    @if (Session::has('status'))
        toastr.success("{{ Session::get('status') }}")
    @endif
</script>



</body>

</html>
