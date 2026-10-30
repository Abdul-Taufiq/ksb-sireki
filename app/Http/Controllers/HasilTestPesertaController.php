<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Quiz\AnswerTes;
use App\Models\Quiz\BankSoal;
use App\Models\Quiz\KategoriSoal;
use App\Models\Quiz\Kraepelin;
use App\Models\Quiz\KraepelinAnswer;
use App\Models\Quiz\PaketSoal;
use App\Services\PelamarServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class HasilTestPesertaController extends Controller
{
    // protected $pelamarServices;
    // public function __construct(PelamarServices $pelamarServices)
    // {
    //     $this->pelamarServices = $pelamarServices;
    // }


    // ============================
    // ADMIN
    public function index(Request $request)
    {
        $user = Auth::user();
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();


        if ($request->ajax()) {
            // query
            $query = Pelamar::whereNotNull('nama');

            // Filter
            if (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } else {
                $data = $query;
            }

            // filter cabang
            if (!empty($request->id_cabang) && $request->id_cabang != 99) {
                $data = $query->where('id_cabang', $request->id_cabang);
            } else {
                if (auth()->user()->level == 'MEDIUM USER') {
                    $data = $query->where('id_cabang', $user->id_cabang);
                } else {
                    $data = $query;
                }
            }

            // filter status_filter
            if (!empty($request->status_filter)) {
                $data = $query->where('status', $request->status_filter);
            } else {
                $data = $query;
            }


            // return ke data table
            return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->cabang ?? 'ALL CABANG';
                })
                ->addColumn('action', function ($data) use ($user) {
                    $button = '<a href="' . route('hasil-test-peserta.show', base64_encode($data->id_pelamar)) . '"
                                    class="btn btn-info btn-sm detail_data btn-table" >
                                    <i class="bi bi-eye-fill"></i>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('page.pelamar-hasil-tes.index', [
            "title" => "Data Hasil Tes Pelamar",
        ]);
    }



    public function show($id)
    {
        $pelamar = Pelamar::where('id_pelamar', base64_decode($id))->first();
        $paket = PaketSoal::with('paketkategori.kategori')->findOrFail($pelamar->id_paket_soal)->first();

        return view('page.pelamar-hasil-tes.show', [
            "title" => "Show Hasil Tes Pelamar",
            "pelamar" => $pelamar,
            "paket" => $paket,
        ]);
    }


    public function showDetail($idPelamar, $idSoal)
    {
        $pelamar = Pelamar::where('id_pelamar', base64_decode($idPelamar))->first();
        $kategori = KategoriSoal::findOrFail(base64_decode($idSoal));

        $periodeStats = [];

        if ($kategori->nama_tes == 'Kraepelin Rekrut' || $kategori->nama_tes == 'Kraepelin Assesment') {
            $soal = Kraepelin::with('answer')->where('id_kategori_soal', $kategori->id)->get();
            $answer = KraepelinAnswer::where('id_pelamar', $pelamar->id_pelamar)->get();

            // kelompokkan berdasarkan periode
            $periodeStats = $answer->groupBy('answer_periode')->map(function ($items) {
                return [
                    'total' => $items->count(),
                    'benar' => $items->where('is_correct', 'true')->count(),
                    'salah' => $items->where('is_correct', 'false')->count(),
                ];
            });

            // contoh akses: $periodeStats[1]['benar'], $periodeStats[2]['salah'], dst.
        } else {
            $soal = BankSoal::with('answer')->where('id_kategori_soal', $kategori->id)->get();
        }

        $benar = 0;
        $salah = 0;
        $tgl_pengerjaan = '';

        foreach ($soal as $item) {
            foreach ($item->answer as $ans) {
                if ($ans->is_correct == 'true') {
                    $benar++;
                } else {
                    $salah++;
                }

                $tgl_pengerjaan = $ans->first()->created_at;
            }
        }

        return view('page.pelamar-hasil-tes.detail', [
            "title" => "Detail Hasil Tes",
            "pelamar" => $pelamar,
            "kategori" => $kategori,
            "soal" => $soal,
            "benar" => $benar,
            "salah" => $salah,
            'tgl_pengerjaan' => $tgl_pengerjaan,
            "periodeStats"  => $periodeStats,
        ]);
    }


    public function gantiJawaban($id, $is_correct, $kategori_soal)
    {
        if ($kategori_soal == 'Kraepelin Rekrut' || $kategori_soal == 'Kraepelin Assesment') {
            $answer = KraepelinAnswer::findOrFail($id);
        } else {
            $answer = AnswerTes::findOrFail($id);
        }

        $answer->is_correct = $is_correct;
        $answer->save();

        return redirect()->back()->with('AlertSuccess', 'Jawaban berhasil diubah!');
    }
}
