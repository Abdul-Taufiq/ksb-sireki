<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Services\BankSoal\BankSoalServices;
use Illuminate\Http\Request;

class IndexBankSoalController extends Controller
{
    protected $soalSesi;

    public function __construct(BankSoalServices $soalSesi)
    {
        $this->soalSesi = $soalSesi;
    }


    public function sesiOne(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Sesi One');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Sesi 1',
            'id_kategori_soal' => '1',
            'namaTes' => 'Sesi One',
            'jns_tes' => 'Uraian',
            'urlIndex' =>  'sesiOne'
        ]);
    }



    public function pengetahuanPerbankan(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Pengetahuan Perbankan');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Pengetahuan Perbankan',
            'id_kategori_soal' => '2',
            'namaTes' => 'Pengetahuan Perbankan',
            'jns_tes' => 'Uraian',
            'urlIndex' => 'pengetahuan-perbankan'
        ]);
    }


    public function analogiVerbal(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Analogi Verbal');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Analogi Verbal',
            'id_kategori_soal' => '4',
            'namaTes' => 'Analogi Verbal',
            'jns_tes' => 'Pilihan Ganda',
            'urlIndex' => 'analogi-verbal'
        ]);
    }


    public function hitungCepat(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Hitung Cepat');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Hitung Cepat',
            'id_kategori_soal' => '5',
            'namaTes' => 'Hitung Cepat',
            'jns_tes' => 'Soal Isian Singkat',
            'urlIndex' => 'hitung-cepat'
        ]);
    }


    public function tesIntegritas(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Integritas');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Integritas',
            'id_kategori_soal' => '6',
            'namaTes' => 'Tes Integritas',
            'jns_tes' => 'Pilihan Ganda',
            'urlIndex' => 'tes-integritas'
        ]);
    }


    public function tesInfoSingkat(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Informasi Singkat');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Informasi Singkat',
            'id_kategori_soal' => '7',
            'namaTes' => 'Tes Informasi Singkat',
            'jns_tes' => 'Isian Singkat (TTS) Berpetunjuk',
            'urlIndex' => 'tes-informasi-singkat'
        ]);
    }


    public function tesPenalaran(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Penalaran Analitik');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Penalaran Analitik',
            'id_kategori_soal' => '8',
            'namaTes' => 'Tes Penalaran Analitik',
            'jns_tes' => 'Pilihan Ganda',
            'urlIndex' => 'tes-penalaran-analitik'
        ]);
    }


    public function tesKemampuanVerbal(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Kemapuan Verbal');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Kemapuan Verbal',
            'id_kategori_soal' => '9',
            'namaTes' => 'Tes Kemapuan Verbal',
            'jns_tes' => 'Pilihan Ganda',
            'urlIndex' => 'tes-kemampuan-verbal'
        ]);
    }


    public function tesKetelitian(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Ketelitian');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Ketelitian',
            'id_kategori_soal' => '10',
            'namaTes' => 'Tes Ketelitian',
            'jns_tes' => 'Tes Objektif Benar-Salah atau Tes Pencocokan',
            'urlIndex' => 'tes-ketelitian'
        ]);
    }


    public function tesKemampuanKuantitatif(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Kemampuan Kuantitatif');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Kemampuan Kuantitatif',
            'id_kategori_soal' => '11',
            'namaTes' => 'Tes Kemampuan Kuantitatif',
            'jns_tes' => 'Pilihan Ganda',
            'urlIndex' => 'tes-kemampuan-kuantitatif'
        ]);
    }


    public function jabatanAnalis(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Jabatan Analis Kredit');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Jabatan Analis Kredit',
            'id_kategori_soal' => '12',
            'namaTes' => 'Tes Jabatan Analis Kredit',
            'jns_tes' => 'Uraian',
            'urlIndex' => 'analis-kredit'
        ]);
    }


    public function jabatanAudit(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Jabatan Audit Internal');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Jabatan Audit Internal',
            'id_kategori_soal' => '13',
            'namaTes' => 'Tes Jabatan Audit Internal',
            'jns_tes' => 'Pilihan Ganda + Uraian',
            'urlIndex' => 'audit-internal'
        ]);
    }


    public function jabatanMarketing(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Jabatan Marketing');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Jabatan Marketing',
            'id_kategori_soal' => '14',
            'namaTes' => 'Tes Jabatan Marketing',
            'jns_tes' => 'Uraian',
            'urlIndex' => 'marketing'
        ]);
    }


    public function jabatanPerkreditan(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Bidang Perkreditan');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Bidang Perkreditan',
            'id_kategori_soal' => '15',
            'namaTes' => 'Tes Bidang Perkreditan',
            'jns_tes' => 'Uraian',
            'urlIndex' => 'bidang-perkreditan'
        ]);
    }


    public function jabatanLegal(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Jabatan Bidang Legal');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Jabatan Bidang Legal',
            'id_kategori_soal' => '16',
            'namaTes' => 'Tes Jabatan Bidang Legal',
            'jns_tes' => 'Pilihan Ganda + Uraian',
            'urlIndex' => 'bidang-legal'
        ]);
    }


    public function jabatanRemedial(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Tes Jabatan Remedial');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Tes Jabatan Remedial',
            'id_kategori_soal' => '17',
            'namaTes' => 'Tes Jabatan Remedial',
            'jns_tes' => 'Pilihan Ganda + Uraian',
            'urlIndex' => 'remedial'
        ]);
    }


    public function swot(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'Analisa Diri (SWOT)');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal Analisa Diri (SWOT)',
            'id_kategori_soal' => '18',
            'namaTes' => 'Analisa Diri (SWOT)',
            'jns_tes' => 'Uraian',
            'urlIndex' => 'swot'
        ]);
    }


    public function disc(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'DISC');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal DISC',
            'id_kategori_soal' => '19',
            'namaTes' => 'DISC',
            'jns_tes' => 'Pilihan Paksa dari 4 pernyataan tiap soal',
            'urlIndex' => 'disc'
        ]);
    }


    public function mbti(Request $request)
    {
        if ($request->ajax()) {
            return $this->soalSesi->index($request, 'MBTI');
        }

        return view('page.banksoal.index-bank-soal', [
            'title' => 'Soal MBTI',
            'id_kategori_soal' => '20',
            'namaTes' => 'MBTI',
            'jns_tes' => 'Pilihan Paksa dari 2 pernyataan tiap soal',
            'urlIndex' => 'mbti'
        ]);
    }
}
