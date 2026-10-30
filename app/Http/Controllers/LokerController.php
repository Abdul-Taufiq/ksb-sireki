<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Loker;
use App\Services\LokerServices;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LokerController extends Controller
{
    protected $lokerServices;

    public function __construct(LokerServices $lokerServices)
    {
        $this->lokerServices = $lokerServices;

        // Middleware hanya untuk method create
        // $this->middleware('ceklevel:SUPER USER,DIREKTUR')->only('create');

        // Kalau mau untuk beberapa method sekaligus
        $this->middleware('ceklevel:SUPER USER,DIREKTUR')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->lokerServices->index($request);
        }

        return view('page.loker.index', [
            "title" => "Data Lowongan Kerjaan"
        ]);
    }


    public function create()
    {
        $cbg = Cabang::orderBy('id_cabang', 'ASC')->get();
        return view('page.loker.create-edit-loker', [
            "title" => "Tambah Data",
            'tipe' => "create",
            'loker' => null,
            'cabang' => $cbg
        ]);
    }



    public function store(Request $request)
    {
        $this->lokerServices->store($request);
        return redirect(route('loker.index'))->with('AlertSuccess', 'DATA LOKER BERHASIL DITAMBAH!');
    }



    public function show($id)
    {
        $loker = Loker::findorfail($id);
        return view('page.loker.show', compact('loker'), [
            'title' => 'Show Data Loker'
        ]);
    }



    public function edit($id)
    {
        $loker = Loker::findOrFail(base64_decode($id));
        $cbg = Cabang::orderBy('id_cabang', 'ASC')->get();
        return view('page.loker.create-edit-loker', [
            "title" => "Update Loker",
            'tipe' => 'edit',
            'loker' => $loker,
            'cabang' => $cbg
        ]);
    }



    public function update(Request $request, $id)
    {
        $this->lokerServices->update($request, $id);
        return redirect('loker')->with('AlertSuccess', 'DATA LOKER BERHASIL DIUBAH!');
    }


    public function destroy($id)
    {
        $loker = Loker::findOrFail(base64_decode($id));

        // hapus file gambar lama
        if ($loker->gambar) {
            $path = public_path('file_upload/img/' . $loker->gambar);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $loker->delete();
        return response()->json(['success' => true]);
        // return redirect('loker')->with('AlertSuccess', 'DATA LOKER BERHASIL DIHAPUS!');
    }
}
