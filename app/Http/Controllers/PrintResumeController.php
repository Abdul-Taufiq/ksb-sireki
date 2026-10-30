<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\PrintResume;
use App\Models\Quiz\AnswerTes;
use App\Models\Quiz\Jadwal;
use App\Models\Quiz\JadwalXPelamar;
use App\Models\Quiz\KraepelinAnswer;
use App\Models\Quiz\PaketSoal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintResumeController extends Controller
{
    public function create($idPelamar)
    {
        $ids = base64_decode($idPelamar);
        $pelamar = Pelamar::findOrFail($ids);
        $resume = PrintResume::where('id_pelamar', $ids)->first();

        return view('page.pelamar-hasil-tes.create-resume', [
            'title' => 'Add/edit data Resume',
            'pelamar' => $pelamar,
            'resume' => $resume
        ]);
    }


    public function store(Request $request)
    {
        if ($request->id_resume == null) {
            $resume = new PrintResume();
        } else {
            $resume = PrintResume::findOrFail(base64_decode($request->id_resume));
        }

        $penilaian = [];

        for ($i = 1; $i <= 5; $i++) {
            $tes        = $request->input("tes_$i");
            $skor       = $request->input("skor_$i");
            $keterangan = $request->input("keterangan_$i");

            // cek apakah semua field bukan "-"
            // if ($tes !== '-' && $skor !== '-' && $keterangan !== '-') {
            $penilaian[] = [
                'id'         => $i,
                'tes'        => $tes,
                'skor'       => $skor,
                'keterangan' => $keterangan,
            ];
            // }
        }

        $resume->id_pelamar = base64_decode($request->id_pelamar);
        $resume->penilaian_tes = json_encode($penilaian);
        $resume->analisa_kelebihan = $request->analisa_kelebihan;
        $resume->analisa_kekurangan = $request->analisa_kekurangan;
        $resume->catatan_slik = $request->catatan_slik;
        $resume->kondite_tempat_kerja = $request->kondite_tempat_kerja;
        $resume->catatan_lainnya = $request->catatan_lainnya;
        $resume->rekomendasi_sdm = $request->rekomendasi_sdm;
        $resume->save();

        return redirect()->back()->with('AlertSuccess', 'Data Berhasil disimpan!');
    }


    public function print($idPelamar)
    {
        $pelamar = Pelamar::findOrFail(base64_decode($idPelamar));
        $resume = PrintResume::where('id_pelamar', $pelamar->id_pelamar)->first();
        // semua jadwal pelamar
        $jadwals = $pelamar->jadwals;
        // ambil jadwal dengan kegiatan tertentu
        $jadwalPsikotes = $pelamar->jadwals()
            ->where('kegiatan', 'Assesment/Psikotes')
            ->first();

        $paket = PaketSoal::with('paketkategori.kategori')->findOrFail($pelamar->id_paket_soal);

        $answers = AnswerTes::where('id_pelamar', $pelamar->id_pelamar)
            ->where('is_correct', 'true')
            ->get();

        $answers_krap = KraepelinAnswer::where('id_pelamar', $pelamar->id_pelamar)
            ->where('is_correct', 'true')
            ->get();

        $pdf = Pdf::loadView(
            'page.pelamar-hasil-tes.print-resume-tes',
            [
                'title' => 'Print Resume Tes AN.' . $pelamar->nama,
                'resume' => $resume,
                'pelamar' => $pelamar,
                'paket' => $paket,
                'jadwal' => $jadwalPsikotes,
                'answers' => $answers,
                'answers_krap' => $answers_krap,

            ]
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->stream('Print Resume Tes An.' . $pelamar->nama . '.pdf');
    }
}
