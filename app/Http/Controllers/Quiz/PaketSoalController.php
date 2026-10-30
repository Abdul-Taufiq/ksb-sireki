<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\KategoriSoal;
use App\Models\Quiz\PaketSoal;
use App\Models\Quiz\PaketXKategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PaketSoalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();

        if ($request->ajax()) {
            // query
            // $query = Loker::when($user->level === 'MEDIUM USER', fn($q)
            // => $q->where('id_cabang', $user->id_cabang));
            $query = PaketSoal::with('paketkategori.kategori');

            // Filter
            if (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } else {
                $data = $query;
            }


            // return ke data table
            return DataTables::of($data)
                ->addColumn('list_tes', function ($row) {
                    $table = '<table class="table table-sm mb-0 small" >';
                    $table .= '<thead>';
                    $table .= '<tr>';
                    $table .= '<th>#</th>';
                    $table .= '<th>Nama Tes</th>';
                    $table .= '<th>Durasi</th>';
                    $table .= '</tr>';
                    $table .= '</thead>';
                    $table .= '<tbody>';
                    foreach ($row->paketkategori as $i => $relasi) {
                        $table .= '<tr>';
                        $table .= '<td>' . ($i + 1) . '</td>';
                        $table .= '<td>' . $relasi->kategori->nama_tes . '</td>';
                        $table .= '<td>' . $relasi->kategori->waktu . ' ' . $relasi->kategori->satuan_waktu . '</td>';
                        $table .= '</tr>';
                    }
                    $table .= '</tbody>';
                    $table .= '</table>';

                    // $html = '<ol>';
                    // foreach ($row->paketkategori as $i => $relasi) {
                    //     $html .= '<li>' . $relasi->kategori->nama_tes . '</li>';
                    // }
                    // $html .= '</ol>';
                    return $table;
                })
                // ->addColumn('durasi', function ($row) {
                //     $html = '<ol>';
                //     foreach ($row->paketkategori as $relasi) {
                //         $html .= '<li>' . $relasi->kategori->waktu . ' ' . $relasi->kategori->satuan_waktu . '</li>';
                //     }
                //     $html .= '</ol>';
                //     return $html;
                // })
                ->addColumn('action', function ($data) use ($user) {
                    // $button = '<a data-bs-toggle="modal" data-bs-target="#myModal" 
                    //                 id="' . base64_encode($data->id) . '" 
                    //                 class="btn btn-info btn-sm detail_data btn-table">
                    //                 <i class="bi bi-eye-fill"></i>
                    //             </a>';

                    switch ($user->jabatan) {
                        case 'TSI':
                        case 'SDM':
                            $button = '<a href="' . route('paket-soal.edit',  base64_encode($data->id)) . '"
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
                            $button = '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="bi bi-pencil-square"></i></a>';
                            break;
                    }

                    return $button;
                })
                ->rawColumns(['action', 'list_tes', 'durasi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('page.paket-soal.index', ['title' => 'Paket Tes']);
    }


    public function create()
    {
        $kategori = KategoriSoal::orderBy('created_at', 'asc')->get();
        return view('page.paket-soal.create-edit', [
            'title' => 'Tambah Paket Tes',
            'tipe' => 'create',
            'kategori' => $kategori,
            'paket' => null,
        ]);
    }


    public function store(Request $request)
    {
        $paket = new PaketSoal();
        $paket->nama_paket = $request->nama_paket;
        $paket->waktu_aplikasi = $request->waktu_aplikasi;
        $paket->save();

        for ($i = 1; $i <= 50; $i++) {
            if ($request->has('nama_tes_' . $i) && $request->input('nama_tes_' . $i)) {
                $pivot = new PaketXKategori();
                $pivot->id_paket = $paket->id;
                $pivot->id_kategori_soal = $request->input('nama_tes_' . $i);
                $pivot->save();
            }
        }

        return redirect(route('paket-soal.index'))->with('AlertSuccess', 'Data Berhasil Ditambahkan!');
    }


    public function edit($id)
    {
        $kategori = KategoriSoal::orderBy('created_at', 'asc')->get();
        $paket = PaketSoal::findOrFail(base64_decode($id));
        return view('page.paket-soal.create-edit', [
            'title' => 'Edit Paket Tes',
            'tipe' => 'edit',
            'kategori' => $kategori,
            'paket' => $paket,
        ]);
    }


    public function update(Request $request, $id)
    {
        $paket = PaketSoal::findOrFail(base64_decode($id));
        $paket->nama_paket = $request->nama_paket;
        $paket->waktu_aplikasi = $request->waktu_aplikasi;
        $paket->save();

        for ($i = 1; $i <= 50; $i++) {
            if ($request->filled('id_pivot_' . $i) && $request->filled('nama_tes_' . $i)) {
                $pivot = PaketXKategori::findOrFail($request->input('id_pivot_' . $i));

                if ($request->input('aksi_' . $i) == 'Edit') {
                    $pivot->id_kategori_soal = $request->input('nama_tes_' . $i);
                    $pivot->save();
                } else {
                    $pivot->delete();
                }
            } else {
                if ($request->filled('nama_tes_' . $i)) {
                    $pivot = new PaketXKategori();
                    $pivot->id_paket = $paket->id;
                    $pivot->id_kategori_soal = $request->input('nama_tes_' . $i);
                    $pivot->save();
                }
            }
        }

        return redirect(route('paket-soal.index'))->with('AlertSuccess', 'Data Berhasil Diubah!');
    }


    public function destroy($id)
    {
        $soalSesi = PaketSoal::findOrFail(base64_decode($id));
        $soalSesi->delete();

        return response()->json(['success' => true]);
    }
}
