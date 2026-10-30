<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Pelamar;
use App\Models\PrintDokumen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintDokumenController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();


        if ($request->ajax()) {
            // query
            $query = PrintDokumen::with(['pelamar', 'cabang']);

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
                    $button = '<a href="' . route('print-document.show', base64_encode($data->id)) . '"
                                    class="btn btn-info btn-sm detail_data btn-table" >
                                    <i class="bi bi-eye-fill"></i>
                                </a>';

                    switch ($user->jabatan) {
                        case 'TSI':
                        case 'SDM':
                            $button .= '<a href="' . route('print-document.edit', base64_encode($data->id)) . '"
                                            class="btn btn-warning btn-sm edit btn-table">
                                            <span class="icon text-center">
                                                <i class="bi bi-pencil-square"></i>
                                            </span>
                                        </a>';
                            $button .= '
                                <a data-id="' . base64_encode($data->id) . '"
                                    class="btn btn-danger btn-sm delete-btn btn-table">
                                    <span class="icon text-center">
                                        <i class="bi bi-trash"></i>
                                    </span>
                                </a>
                            ';
                            break;

                        default:
                            $button .= '<a class="btn btn-danger btn-sm delete-btn btn-table disabled">
                                    <span class="icon text-center">
                                        <i class="bi bi-trash"></i>
                                    </span></a>';
                            break;
                    }

                    return $button;
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('page.print-dokumen.index', [
            "title" => "Data Dokumen",
        ]);
    }


    public function create()
    {
        $cbg = Cabang::orderBy('id_cabang', 'ASC')->get();
        $pelamar = Pelamar::where('status', 'Offering/Finalisasi')->where('status_tambah_dokumen', null)->get();
        return view('page.print-dokumen.create-edit', [
            "title" => "Tambah Data Dokumen",
            'tipe' => "create",
            'dokumen' => null,
            'pelamar' => $pelamar,
            'cabang' => $cbg
        ]);
    }


    public function store(Request $request)
    {
        $dokumen = new PrintDokumen();
        $dokumen->id_pelamar = $request->id_pelamar;
        $dokumen->id_cabang = $request->id_cabang;
        $dokumen->save();

        $pelamar = Pelamar::find($request->id_pelamar);
        $pelamar->nik = $request->nik;
        $pelamar->status_tambah_dokumen = 'Sudah';
        $pelamar->save();

        return redirect()->route('print-document.index')->with('AlertSuccess', 'Data Dokumen berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $cbg = Cabang::orderBy('id_cabang', 'ASC')->get();
        $pelamar = Pelamar::where('status', 'Offering/Finalisasi')->get();
        $dokumen = PrintDokumen::find(base64_decode($id));
        return view('page.print-dokumen.create-edit', [
            "title" => "Edit Data Dokumen",
            'tipe' => "edit",
            'dokumen' => $dokumen,
            'pelamar' => $pelamar,
            'cabang' => $cbg
        ]);
    }


    public function update(Request $request, $id)
    {
        $dokumen = PrintDokumen::find(base64_decode($id));
        $dokumen->id_pelamar = $request->id_pelamar;
        $dokumen->id_cabang = $request->id_cabang;
        $dokumen->save();

        $pelamar = Pelamar::find($request->id_pelamar);
        $pelamar->nik = $request->nik;
        $pelamar->save();

        return redirect()->route('print-document.index')->with('AlertSuccess', 'Data Dokumen berhasil diubah.');
    }


    public function show($id)
    {
        $dokumen = PrintDokumen::with('pelamar', 'cabang')->find(base64_decode($id));
        return view('page.print-dokumen.show', [
            "title" => "Detail Data Dokumen",
            'dokumen' => $dokumen
        ]);
    }


    public function destroy($id)
    {
        $dokumen = PrintDokumen::findOrFail(base64_decode($id));

        $dokumen->delete();
        return response()->json(['success' => true]);
        // return redirect('loker')->with('AlertSuccess', 'DATA LOKER BERHASIL DIHAPUS!');
    }


    // update data pelamar
    public function updateData(Request $request)
    {
        $dokumen = PrintDokumen::find(base64_decode($request->id));
        $dokumen->nomor_pk = $request->nomor_pk;
        $dokumen->tgl_pk = $request->tgl_pk;
        $dokumen->jns_jamker = $request->jns_jamker;
        $dokumen->atas_nama = $request->atas_nama;
        $dokumen->no_ijazah = $request->no_ijazah;
        $dokumen->tgl_ijazah = $request->tgl_ijazah;
        $dokumen->tingkatan = $request->tingkatan;
        $dokumen->instansi = $request->instansi;
        $dokumen->tgl_penyerahan = $request->tgl_penyerahan;
        $dokumen->save();

        return redirect()->route('print-document.sp-penyerahan-jamker', ['id' => encrypt($dokumen->id)]);
    }


    // Print Dokumen Functions
    public function printPaktaIntegritas($id)
    {
        $dokumen = PrintDokumen::with('pelamar', 'cabang')->find(Crypt::decrypt($id));
        $dokumen->update([
            'tgl_print_pakta' => Carbon::now(),
        ]);

        $pdf = Pdf::loadView(
            'page.print-dokumen.print-pakta',
            [
                'title' => 'Print Pakta Integritas AN.' . $dokumen->pelamar->nama,
                'dokumen' => $dokumen,
            ]
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->stream('Print Pakta Integritas An.' . $dokumen->pelamar->nama . '.pdf');
    }


    public function printKodeEtik($id)
    {
        $dokumen = PrintDokumen::with('pelamar', 'cabang')->find(Crypt::decrypt($id));
        $dokumen->update([
            'tgl_print_kode_etik' => Carbon::now(),
        ]);

        $pdf = Pdf::loadView(
            'page.print-dokumen.print-kode-etik',
            [
                'title' => 'Print Kode Etik AN.' . $dokumen->pelamar->nama,
                'dokumen' => $dokumen,
            ]
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->stream('Print Kode Etik An.' . $dokumen->pelamar->nama . '.pdf');
    }


    public function printSPPenyerahanJamker($id)
    {
        $dokumen = PrintDokumen::with('pelamar', 'cabang')->find(Crypt::decrypt($id));
        $dokumen->update([
            'tgl_print_sp_jamker' => Carbon::now(),
        ]);

        $pdf = Pdf::loadView(
            'page.print-dokumen.print-sp-penyerahan-jamker',
            [
                'title' => 'Print SP Penyerahan Jamker AN.' . $dokumen->pelamar->nama,
                'dokumen' => $dokumen,
            ]
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->stream('Print SP Penyerahan Jamker An.' . $dokumen->pelamar->nama . '.pdf');
    }


    public function printBAPenyerahanJamker($id)
    {
        $dokumen = PrintDokumen::with('pelamar', 'cabang')->find(Crypt::decrypt($id));
        $dokumen->update([
            'tgl_print_ba_jamker' => Carbon::now(),
        ]);

        // Ambil nama bulan dalam bentuk romawi
        $bulanRom = now()->format('m');
        switch ($bulanRom) {
            case 1:
                $bulanRom = "I";
                break;
            case 2:
                $bulanRom = "II";
                break;
            case 3:
                $bulanRom = "III";
                break;
            case 4:
                $bulanRom = "IV";
                break;
            case 5:
                $bulanRom = "V";
                break;
            case 6:
                $bulanRom = "VI";
                break;
            case 7:
                $bulanRom = "VII";
                break;
            case 8:
                $bulanRom = "VIII";
                break;
            case 9:
                $bulanRom = "IX";
                break;
            case 10:
                $bulanRom = "X";
                break;
            case 11:
                $bulanRom = "XI";
                break;
            case 12:
                $bulanRom = "XII";
        }

        if ($dokumen->no_ba_jamker == '') {
            $now = Carbon::now();
            $thn = $now->year;
            $nomer = '';
            $ambil = PrintDokumen::where('no_ba_jamker', 'LIKE', "%/KSB.SDM/%")
                ->orderBy('updated_at', 'desc')
                ->take(1)
                ->get();
            if ($ambil->isEmpty()) {
                $urut = "0001";
                $nomer = $urut . '/KSB.SDM/' . $bulanRom . '/' . $thn;
            } else {
                foreach ($ambil as $item) {
                    $cekTahun = substr($item->no_ba_jamker, -4, 4);
                    if ($cekTahun != $thn) {
                        $urut = "0001";
                        $nomer = $urut . '/KSB.SDM/' . $bulanRom . '/' . $thn;
                    } else {
                        $urut = substr($item->no_ba_jamker, 0, 4);
                        $urut = (int)$urut + 1;
                        $urut = str_pad($urut, 4, '0', STR_PAD_LEFT); // Menggunakan str_pad untuk menambahkan nol di depan
                        $nomer = $urut . '/KSB.SDM/' . $bulanRom . '/' . $thn;
                    }
                }
            }

            $dokumen->no_ba_jamker = $nomer;
            $dokumen->save();
        }


        $pdf = Pdf::loadView(
            'page.print-dokumen.print-ba-penyerahan-jamker',
            [
                'title' => 'Print BA Penyerahan Jamker AN.' . $dokumen->pelamar->nama,
                'dokumen' => $dokumen,
            ]
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->stream('Print BA Penyerahan Jamker An.' . $dokumen->pelamar->nama . '.pdf');
    }


    public function printSPSLIK($id)
    {
        $dokumen = PrintDokumen::with('pelamar', 'cabang')->find(Crypt::decrypt($id));
        $dokumen->update([
            'tgl_print_sp_slik' => Carbon::now(),
        ]);

        $pdf = Pdf::loadView(
            'page.print-dokumen.print-sp-slik',
            [
                'title' => 'Print SP SLIK AN.' . $dokumen->pelamar->nama,
                'dokumen' => $dokumen,
            ]
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->stream('Print SP SLIK An.' . $dokumen->pelamar->nama . '.pdf');
    }


    public function printSuratPernyataan($id)
    {
        $dokumen = PrintDokumen::with('pelamar', 'cabang')->find(Crypt::decrypt($id));

        $pdf = Pdf::loadView(
            'page.print-dokumen.print-sp-pernyataan',
            [
                'title' => 'Print SP Pernyataan AN.' . $dokumen->pelamar->nama,
                'dokumen' => $dokumen,
            ]
        );
        $pdf->setPaper('A4', 'potrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->stream('Print SP Pernyataan An.' . $dokumen->pelamar->nama . '.pdf');
    }
}
