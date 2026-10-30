<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\Quiz\AnswerTes;
use App\Models\Quiz\BankSoal;
use App\Models\Quiz\KategoriSoal;
use App\Models\Quiz\Kraepelin;
use App\Models\Quiz\KraepelinAnswer;
use App\Models\Quiz\PaketSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{

    public function index($nama_tes, $id)
    {
        $userId = Auth::id();
        $paket = PaketSoal::with('paketkategori.kategori')->findOrFail(auth()->user()->id_paket_soal)->first();
        $soal = KategoriSoal::where('nama_tes', $nama_tes)->where('id', base64_decode($id))->first();

        if ($nama_tes == 'Kraepelin Rekrut' || $nama_tes == 'Kraepelin Assesment') {
            $answer =  KraepelinAnswer::where('id_pelamar', $userId)->first();
        } else {
            $answer = AnswerTes::where('id_pelamar', $userId)->where('nama_tes', $nama_tes)->first();
        }


        return view('page.applicant.applicant-tes', [
            'title' => $nama_tes,
            'paket' => $paket,
            'answer' => $answer,
            'soal' => $soal,
        ]);
    }


    public function cekKodeSoal(Request $request)
    {
        $kategori = KategoriSoal::where('id', base64_decode($request->id))->where('nama_tes', $request->nama_tes)->first();

        if ($kategori->password_tes == $request->password_tes) {
            return redirect()->route('applicant.soal', [
                'id' => $request->id,
                'nama_tes' => $request->nama_tes
            ]);
        } else {
            # code...
            return redirect()->back()->with('AlertFail', 'Password Tes Salah!');
        }
    }


    public function soal($id, $nama_tes)
    {
        $paket = PaketSoal::with('paketkategori.kategori')->findOrFail(auth()->user()->id_paket_soal)->first();
        $kategori = KategoriSoal::where('id', base64_decode($id))->where('nama_tes', $nama_tes)->first();


        if ($nama_tes == 'Kraepelin Rekrut' || $nama_tes == 'Kraepelin Assesment') {
            $soal = Kraepelin::where('id_kategori_soal', $kategori->id)->get();
            // acak soal
            $soal = $soal->shuffle();

            return view('page.applicant.applicant-tes-soal-kraepelin', [
                'title' => 'Mengerjakan Soal Tes ' . $kategori->nama_tes,
                'soal' => $soal,
                'paket' => $paket,
                'kategori' => $kategori,
            ]);
        } else {
            $soal = BankSoal::where('id_kategori_soal', $kategori->id)->get();
            $soal = $soal->shuffle();

            return view('page.applicant.applicant-tes-soal', [
                'title' => 'Mengerjakan Soal Tes ' . $kategori->nama_tes,
                'soal' => $soal,
                'paket' => $paket,
                'nama_tes' => $nama_tes,
                'kategori' => $kategori,
            ]);
        }
    }


    public function simpanJawaban(Request $request)
    {
        $userId = Auth::id();

        if ($request->nama_tes != 'DISC' && $request->nama_tes != 'MBTI') {
            for ($i = 1; $i <= 500; $i++) {
                $idSoal = $request->input('id_soal_' . $i);
                $jawaban = $request->input('jawaban_' . $i);
                $nama_tes = $request->input('nama_tes_' . $i);

                $bankSoal = BankSoal::find(base64_decode($idSoal));

                if ($idSoal) {
                    $answer = new AnswerTes();
                    $answer->id_pelamar = $userId;
                    $answer->id_soal = base64_decode($idSoal);
                    $answer->nama_tes = $nama_tes;
                    $answer->answer = $jawaban != null ? $jawaban : '-';

                    if ($bankSoal->kunci_jawaban != null && $bankSoal->kunci_jawaban != '-') {
                        if ($jawaban == $bankSoal->kunci_jawaban) {
                            $answer->is_correct = 'true';
                        } else {
                            $answer->is_correct = 'false';
                        }
                    }

                    $answer->save();
                }
            }
        }

        return redirect()->route('applicant.home')->with('AlertSuccess', 'Jawaban berhasil disimpan!');
    }


    public function autosaveKraepelin(Request $request)
    {
        $userId = Auth::id();

        foreach ($request->jawaban as $item) {

            $idSoal = base64_decode($item['id_soal']);
            $jawaban = $item['jawaban'] ?? null;

            $soal = Kraepelin::find($idSoal);

            if (!$soal) {
                continue;
            }

            $answer = new KraepelinAnswer();

            $answer->id_pelamar = $userId;
            $answer->id_soal = $idSoal;
            $answer->answer = $jawaban;
            $answer->answer_periode = $request->periode;
            $answer->is_correct =
                $soal->kunci_jawaban == $jawaban
                ? 'true'
                : 'false';

            $answer->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Jawaban berhasil disimpan',
        ]);
    }
}
