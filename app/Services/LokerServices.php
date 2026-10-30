<?php

namespace App\Services;

use App\Models\Loker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class LokerServices.
 */
class LokerServices
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
            $query = Loker::whereNotNull('status');

            // Filter
            if (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } else {
                $data = $query;
            }

            // filter cabang
            if (!empty($request->id_cabang)) {
                $data = $query->where('id_cabang', $request->id_cabang);
            } else {
                $data = $query->when($user->level === 'MEDIUM USER', fn($q)
                => $q->where('id_cabang', $user->id_cabang));
            }


            // return ke data table
            return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->cabang ?? 'ALL CABANG';
                })
                ->addColumn('action', function ($data) use ($user) {
                    $button = '<a data-bs-toggle="modal" data-bs-target="#myModal" 
                                    id="' . $data->id_loker . '" 
                                    class="btn btn-info btn-sm detail_data btn-table" 
                                    data-posisi="' . $data->posisi . '">
                                    <i class="bi bi-eye-fill"></i>
                                </a>';

                    switch ($user->jabatan) {
                        case 'TSI':
                        case 'SDM':
                            $button .= '<a href="' . route('loker.edit', base64_encode($data->id_loker)) . '"
                                            class="btn btn-warning btn-sm edit btn-table">
                                            <span class="icon text-center">
                                                <i class="bi bi-pencil-square"></i>
                                            </span>
                                        </a>';
                            $button .= '
                                <a data-id="' . base64_encode($data->id_loker) . '"
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
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
    }


    public function store(Request $request)
    {
        //mengambil data file yang diupload
        $gambar = $request->file('gambar');
        //mengambil nama file
        $fileName = $gambar->getClientOriginalName();
        //memindahkan file ke folder tujuan
        $gambar->move('file_upload/img', $fileName);
        // $gambar->storeAs('file_upload',$gambar->getClientOriginalName());

        $loker = new Loker;
        $loker->id_cabang = $request->id_cabang;
        $loker->kategori = $request->kategori;
        $loker->posisi = $request->posisi;
        $loker->status = auth()->user()->id_cabang == 0 || auth()->user()->id_cabang == 20 ? $request->status : 'Non-active';
        $loker->kualifikasi = $request->kualifikasi;
        $loker->tgl_berakhir = $request->tgl_berakhir;
        $loker->gambar = $fileName;
        $loker->created_at = now();
        $loker->save();
    }


    public function update(Request $request, $id)
    {
        $loker = Loker::findOrFail(base64_decode($id));

        if (!isset($request->cek_gambar)) {
            // cek apakah ada file lama
            if ($loker->gambar) {
                $oldPath = public_path('file_upload/img/' . $loker->gambar);
                if (file_exists($oldPath)) {
                    unlink($oldPath); // hapus file lama
                }
            }

            //mengambil data file yang diupload
            $gambar = $request->file('gambar');
            //mengambil nama file
            $fileName = $gambar->getClientOriginalName();
            //memindahkan file ke folder tujuan
            $gambar->move('file_upload/img', $fileName);

            $loker->gambar = $fileName;
        }

        $loker->id_cabang = $request->id_cabang;
        $loker->kategori = $request->kategori;
        $loker->posisi = $request->posisi;
        $loker->status = $request->status;
        $loker->kualifikasi = $request->kualifikasi;
        $loker->tgl_berakhir = $request->tgl_berakhir;
        $loker->updated_at = now();
        $loker->save();
    }
}
