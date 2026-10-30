<?php

namespace App\Services\BankSoal;

use App\Models\Quiz\Kraepelin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class KraepelinServices.
 */
class KraepelinServices
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
            $query = Kraepelin::whereNotNull('nilai_1');

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
                            $button = '<a href="' . route('kraepelin.edit', base64_encode($data->id)) . '"
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
                // ->editColumn('opsi_jawaban', function ($row) {
                //     $opsi = json_decode($row->opsi_jawaban, true); // pastikan kolom disimpan sebagai JSON
                //     $html = '<ul>';
                //     foreach ($opsi as $val) {
                //         $html .= '<li>' . $val . '</li>';
                //     }
                //     $html .= '</ul>';
                //     return $html;
                // })
                ->rawColumns(['action', 'pertanyaan', 'opsi_jawaban', 'kunci_jawaban'])
                ->addIndexColumn()
                ->make(true);
        }
    }


    public function store(Request $request, $soalSesi)
    {
        // Ambil semua opsi jawaban dari request
        $opsi = [];

        for ($i = 1; $i <= 5; $i++) {
            $val = $request->input("opsi_jawaban_$i");

            // skip kalau kosong/null
            if (empty($val)) {
                continue;
            }

            // khusus opsi ke-5, skip kalau nilainya "-" atau kosong
            if ($i === 5 && ($val === null || $val === '')) {
                continue;
            }

            $opsi[] = $val;
        }

        $soalSesi->nama_tes = $request->nama_tes;
        $soalSesi->jns_tes = $request->jns_tes;
        $soalSesi->pertanyaan = $request->pertanyaan;
        $soalSesi->opsi_jawaban = json_encode($opsi);
        $soalSesi->kunci_jawaban = $request->kunci_jawaban;
        $soalSesi->created_at = now();
        $soalSesi->save();
    }


    public function update(Request $request, $soalSesi)
    {
        // Ambil semua opsi jawaban dari request
        $opsi = [];

        for ($i = 1; $i <= 5; $i++) {
            $val = $request->input("opsi_jawaban_$i");
            // skip kalau kosong/null
            if (empty($val)) {
                continue;
            }

            // khusus opsi ke-5, skip kalau nilainya "-" atau kosong
            if ($i === 5 && ($val === '-' || $val === null || $val === '')) {
                continue;
            }

            $opsi[] = $val;
        }

        $soalSesi->nama_tes = $request->nama_tes;
        $soalSesi->jns_tes = $request->jns_tes;
        $soalSesi->pertanyaan = $request->pertanyaan;
        $soalSesi->opsi_jawaban = $opsi;
        $soalSesi->kunci_jawaban = $request->kunci_jawaban;
        $soalSesi->updated_at = now();
        $soalSesi->save();
    }

    public function destroy($id)
    {
        $soalSesi = Kraepelin::findOrFail(base64_decode($id));
        $soalSesi->delete();

        return response()->json(['success' => true]);
    }
}
