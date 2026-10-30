<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\KategoriSoal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KategoriSoalController extends Controller
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
            $query = KategoriSoal::whereNotNull('waktu');

            // Filter
            if (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } else {
                $data = $query;
            }


            // return ke data table
            return DataTables::of($data)
                ->addColumn('action', function ($data) use ($user) {
                    // $button = '<a data-bs-toggle="modal" data-bs-target="#myModal" 
                    //                 id="' . base64_encode($data->id) . '" 
                    //                 class="btn btn-info btn-sm detail_data btn-table">
                    //                 <i class="bi bi-eye-fill"></i>
                    //             </a>';

                    switch ($user->jabatan) {
                        case 'TSI':
                        case 'SDM':
                            $button = '<a href="' . route('kategori-soal.edit',  base64_encode($data->id)) . '"
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
                ->rawColumns(['action', 'petunjuk_tes'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('page.kategori-soal.index', ['title' => 'Kategori Soal']);
    }


    public function create()
    {
        return view('page.kategori-soal.create-edit', [
            'title' => 'Tambah Kategori Soal',
            'tipe' => 'create',
            'kategori' => null,
        ]);
    }


    public function store(Request $request)
    {
        $kategori = new KategoriSoal();
        $kategori->password_tes = $request->password_tes;
        $kategori->nama_tes = $request->nama_tes;
        $kategori->jumlah_soal = $request->jumlah_soal;
        $kategori->waktu = $request->waktu;
        $kategori->satuan_waktu = $request->satuan_waktu;
        $kategori->istimewa_start = $request->istimewa_start;
        $kategori->istimewa_end = $request->istimewa_end;
        $kategori->baik_start = $request->baik_start;
        $kategori->baik_end = $request->baik_end;
        $kategori->cukup_start = $request->cukup_start;
        $kategori->cukup_end = $request->cukup_end;
        $kategori->kurang_start = $request->kurang_start;
        $kategori->kurang_end = $request->kurang_end;
        $kategori->buruk_start = $request->buruk_start;
        $kategori->petunjuk_tes = $request->petunjuk_tes;
        $kategori->save();

        return redirect(route('kategori-soal.index'))->with('AlertSuccess', 'Data Berhasil Ditambahkan!');
    }


    public function edit($id)
    {
        $kategori = KategoriSoal::findOrFail(base64_decode($id));

        return view('page.kategori-soal.create-edit', [
            'title' => 'Edit Kategori Soal',
            'tipe' => 'edit',
            'kategori' => $kategori,
        ]);
    }


    public function update(Request $request, $id)
    {
        $kategori = KategoriSoal::findOrFail(base64_decode($id));
        $kategori->password_tes = $request->password_tes;
        $kategori->nama_tes = $request->nama_tes;
        $kategori->jumlah_soal = $request->jumlah_soal;
        $kategori->waktu = $request->waktu;
        $kategori->satuan_waktu = $request->satuan_waktu;
        $kategori->istimewa_start = $request->istimewa_start;
        $kategori->istimewa_end = $request->istimewa_end;
        $kategori->baik_start = $request->baik_start;
        $kategori->baik_end = $request->baik_end;
        $kategori->cukup_start = $request->cukup_start;
        $kategori->cukup_end = $request->cukup_end;
        $kategori->kurang_start = $request->kurang_start;
        $kategori->kurang_end = $request->kurang_end;
        $kategori->buruk_start = $request->buruk_start;
        $kategori->petunjuk_tes = $request->petunjuk_tes;
        $kategori->save();

        return redirect(route('kategori-soal.index'))->with('AlertSuccess', 'Data Berhasil Ditambahkan!');
    }


    public function destroy($id)
    {
        $kategori = KategoriSoal::findOrFail(base64_decode($id));
        $kategori->delete();

        return response()->json(['success' => true]);
    }
}
