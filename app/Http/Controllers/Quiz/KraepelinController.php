<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Kraepelin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KraepelinController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
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
                    ->addColumn('kategori', function ($data) {
                        return $data->kategori->nama_tes;
                    })
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

        return view('page.banksoal.kraepelin-index', [
            'title' => 'Soal Kraepelin'
        ]);
    }


    public function create()
    {
        return view('page.banksoal.kraepelin-create-edit', [
            'title' => 'Soal Kraepelin',
            'tipe' => 'create',
            'krae' => null
        ]);
    }


    public function store(Request $request)
    {
        $krae = new Kraepelin();
        $krae->id_kategori_soal = $request->id_kategori_soal;
        $krae->nilai_1 = $request->nilai_1;
        $krae->nilai_2 = $request->nilai_2;
        $krae->kunci_jawaban = $request->kunci_jawaban;
        $krae->save();

        return redirect(route('kraepelin.index'))->with('AlertSuccess', 'Data Berhasil Disimpan!');
    }


    public function edit($id)
    {
        $krae = Kraepelin::findOrFail(base64_decode($id));

        return view('page.banksoal.kraepelin-create-edit', [
            'title' => 'Soal Kraepelin',
            'tipe' => 'edit',
            'krae' => $krae
        ]);
    }


    public function update(Request $request, $id)
    {
        $krae = Kraepelin::findOrFail(base64_decode($id));
        $krae->id_kategori_soal = $request->id_kategori_soal;
        $krae->nilai_1 = $request->nilai_1;
        $krae->nilai_2 = $request->nilai_2;
        $krae->kunci_jawaban = $request->kunci_jawaban;
        $krae->save();

        return redirect(route('kraepelin.index'))->with('AlertSuccess', 'Data Berhasil Disimpan!');
    }


    public function destroy($id)
    {
        $soalSesi = Kraepelin::findOrFail(base64_decode($id));
        $soalSesi->delete();

        return response()->json(['success' => true]);
    }
}
