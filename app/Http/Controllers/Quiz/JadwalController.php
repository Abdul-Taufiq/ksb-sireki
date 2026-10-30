<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Models\Quiz\Jadwal;
use App\Models\Quiz\JadwalXPelamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JadwalController extends Controller
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
            $query = Jadwal::with('jadwalpelamar.pelamar');

            // Filter
            if (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } else {
                $data = $query;
            }


            // return ke data table
            return DataTables::of($data)
                ->addColumn('action', function ($data) use ($user) {
                    $button = '<a data-bs-toggle="modal" data-bs-target="#myModal" 
                                    id="' . base64_encode($data->id) . '" 
                                    class="btn btn-info btn-sm detail_data btn-table">
                                    <i class="bi bi-eye-fill"></i>
                                </a>';

                    switch ($user->jabatan) {
                        case 'TSI':
                        case 'SDM':
                            $button .= '<a href="' . route('penjadwalan.edit',  base64_encode($data->id)) . '"
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
                            $button .= '<a class="edit btn btn-warning btn-sm edit-post disabled"><i class="bi bi-pencil-square"></i></a>';
                            break;
                    }

                    return $button;
                })
                ->rawColumns(['action', 'keterangan'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('page.penjadwalan.index', ['title' => 'Penjadwalan']);
    }


    public function create()
    {
        $pelamar = Pelamar::where('status', 'Not Like', 'Ditolak')->orderBy('created_at', 'asc')
            ->whereBetween('created_at', [
                Carbon::now()->subMonths(6)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->get();
        return view('page.penjadwalan.create-edit', [
            'title' => 'Tambah Paket Tes',
            'tipe' => 'create',
            'pelamar' => $pelamar,
            'jadwal' => null,
        ]);
    }


    public function store(Request $request)
    {
        $jadwal = new Jadwal();
        $jadwal->kegiatan = $request->kegiatan;
        $jadwal->tgl_jadwal = $request->tgl_jadwal;
        $jadwal->keterangan = $request->keterangan;
        $jadwal->save();

        for ($i = 1; $i <= 50; $i++) {
            if ($request->has('id_pelamar_' . $i) && $request->input('id_pelamar_' . $i)) {
                $pivot = new JadwalXPelamar();
                $pivot->id_jadwal = $jadwal->id;
                $pivot->id_pelamar = $request->input('id_pelamar_' . $i);
                $pivot->save();
            }
        }

        return redirect(route('penjadwalan.index'))->with('AlertSuccess', 'Data Berhasil Ditambahkan!');
    }


    public function show($id)
    {
        $jadwal = Jadwal::with('jadwalpelamar.pelamar')->where('id', base64_decode($id))->first();

        return view('page.penjadwalan.show', [
            'title' => 'Show Data',
            'jadwal' => $jadwal
        ]);
    }


    public function edit($id)
    {
        $pelamar = Pelamar::where('status', 'Not Like', 'Ditolak')->orderBy('created_at', 'asc')
            ->whereBetween('created_at', [
                Carbon::now()->subMonths(4)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->get();

        $jadwal = Jadwal::findOrFail(base64_decode($id));
        return view('page.penjadwalan.create-edit', [
            'title' => 'Edit Paket Tes',
            'tipe' => 'edit',
            'pelamar' => $pelamar,
            'jadwal' => $jadwal,
        ]);
    }


    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail(base64_decode($id));
        $jadwal->kegiatan = $request->kegiatan;
        $jadwal->tgl_jadwal = $request->tgl_jadwal;
        $jadwal->keterangan = $request->keterangan;
        $jadwal->save();

        for ($i = 1; $i <= 50; $i++) {
            if ($request->filled('id_pivot_' . $i) && $request->filled('id_pelamar_' . $i)) {
                $pivot = JadwalXPelamar::findOrFail($request->input('id_pivot_' . $i));

                if ($request->input('aksi_' . $i) == 'Edit') {
                    $pivot->id_pelamar = $request->input('id_pelamar_' . $i);
                    $pivot->save();
                } else {
                    $pivot->delete();
                }
            } else {
                if ($request->has('id_pelamar_' . $i) && $request->input('id_pelamar_' . $i)) {
                    $pivot = new JadwalXPelamar();
                    $pivot->id_jadwal = $jadwal->id;
                    $pivot->id_pelamar = $request->input('id_pelamar_' . $i);
                    $pivot->save();
                }
            }
        }

        return redirect(route('penjadwalan.index'))->with('AlertSuccess', 'Data Berhasil Diubah!');
    }


    public function destroy($id)
    {
        $soalSesi = Jadwal::findOrFail(base64_decode($id));
        $soalSesi->delete();

        return response()->json(['success' => true]);
    }
}
