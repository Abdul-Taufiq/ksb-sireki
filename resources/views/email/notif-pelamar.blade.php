<div style="background-color: #f2f2f2; padding: 20px;">
    <div style="background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <h3 style="font-family: Arial, sans-serif;">Hallo, {{ $nama }}</h3>
        <p style="font-family: Arial, sans-serif;">
            Terimakasih atas partisipasi Anda dengan Apply lamaran pekerjaan pada PT BPR Kusuma Sumbing.<br>
            Berikut kami sampaikan Kode Lamaran dan Password untuk melakukan pengecekan pengajuan lamaran Anda.
        <table style="text-align: left;">
            <tr>
                <th>Kode Lamaran</th>
                <td>: {{ $kode_pelamar }}</td>
            </tr>
            <tr>
                <th>Password</th>
                <td>: {{ $tgl_lahir->format('dmY') }}</td>
            </tr>
            <tr>
                <th>Posisi Yang Dilamar</th>
                <td>: {{ $posisi }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan Lamaran</th>
                <td>: {{ $created->translatedFormat('d F Y | H:i') }} WIB</td>
            </tr>
        </table> <br>
        Info lebih lengkap serta cek progres lamaran Anda dapat di tinjau
        <a href="https://karir.bprkusumasumbing.com/"> Disini!</a>
        <br><br>
        <br><br>

        <b>Regard,</b> <br>
        <b>PT BPR Kusuma Sumbing</b>
        </p>
    </div>
</div>
