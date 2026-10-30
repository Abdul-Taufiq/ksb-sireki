<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Imports\BankSoalImport;
use App\Models\Quiz\BankSoal;
use App\Services\BankSoal\BankSoalServices;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BankSoalController extends Controller
{
    protected $soalSesi;

    public function __construct(BankSoalServices $soalSesi)
    {
        $this->soalSesi = $soalSesi;
    }


    public function create($tes, $jns_tes, $id_kategori)
    {
        $route = route('sesi-tes.store');
        return view('page.banksoal.create-edit-sesi-tes', [
            'title' => 'Tambah Soal ' . $tes,
            'nama_tes' => $tes,
            'jns_tes' => $jns_tes,
            'id_kategori_soal' => $id_kategori,
            'tipe' => 'create',
            'route' => $route,
            'sesiOne' => null
        ]);
    }


    public function createImport($tes, $jns_tes, $id_kategori)
    {
        $route = route('sesi-tes.store.import');
        return view('page.banksoal.create-import-sesi-tes', [
            'title' => 'Tambah Soal ' . $tes,
            'nama_tes' => $tes,
            'jns_tes' => $jns_tes,
            'id_kategori_soal' => $id_kategori,
            'tipe' => 'create',
            'route' => $route,
            'sesiOne' => null
        ]);
    }


    public function show($id)
    {
        $data = BankSoal::findOrFail(base64_decode($id));
        return view('page.banksoal.show', [
            'title' => 'Show Data',
            'data' => $data
        ]);
    }


    public function storeImport(Request $request)
    {
        // Simpan file ke server
        $data = $request->file('file_excel');
        $originalName = $data->getClientOriginalName();
        $extension = $data->getClientOriginalExtension();

        $namaFile = pathinfo($originalName, PATHINFO_FILENAME) . '.' . $extension;
        $filePath = public_path('file_upload/EXCEL/' . $namaFile);

        // Simpan file ke folder tujuan
        $data->move(public_path('file_upload/EXCEL'), $namaFile);

        // Jalankan import dengan parameter tambahan
        Excel::import(
            new BankSoalImport(
                base64_decode($request->id_kategori_soal),
                $request->nama_tes,
                $request->jns_tes
            ),
            $filePath
        );

        // 🔹 Hapus file setelah selesai import
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return redirect()->back()->with('AlertSuccess', 'Data Berhasil Ditambahkan!');
    }


    public function store(Request $request)
    {
        $soalSesi = new BankSoal();

        $this->soalSesi->store($request, $soalSesi);

        return redirect()->back()->with('AlertSuccess', 'Data Berhasil Ditambahkan!');
    }


    public function edit($id, $tes, $jns_tes, $id_kategori)
    {
        $sesiOne = BankSoal::findOrFail(base64_decode($id));
        $route = route('sesi-tes.update', base64_encode($sesiOne->id));

        return view('page.banksoal.create-edit-sesi-tes', [
            'title' => 'Update Soal ' . $tes,
            'nama_tes' => $tes,
            'jns_tes' => $jns_tes,
            'id_kategori_soal' => $id_kategori,
            'tipe' => 'edit',
            'route' => $route,
            'sesiOne' => $sesiOne
        ]);
    }


    public function update(Request $request, $id)
    {
        $soalSesi = BankSoal::findOrFail(base64_decode($id));

        $this->soalSesi->update($request, $soalSesi);

        return redirect()->back()->with('AlertSuccess', 'Data Berhasil Diubah!');
    }


    public function destroy($id)
    {
        $soalSesi = BankSoal::findOrFail(base64_decode($id));
        $soalSesi->delete();

        return response()->json(['success' => true]);
    }
}
