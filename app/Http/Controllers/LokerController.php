<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LokerController extends Controller
{
    public function index()
    {
        $data = Loker::all();
        return view('loker.loker', compact('data'), [
            "tittle" => "Data Loker"
        ]);
    }


    public function create()
    {
        $now = Carbon::now();
        return view('loker.add-loker', [
            "tittle" => "Tambah Data Job Baru"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|max:5024',
        ], [
            // PESAN ERROR
            'gambar.image' => 'File Harus Berformat Gambar!',
            'gambar.max' => 'File Terlalu Besar! Maximal 5 MB',
        ]);


        //mengambil data file yang diupload
        $gambar = $request->file('gambar');
        //mengambil nama file
        $fileName = $gambar->getClientOriginalName();
        //memindahkan file ke folder tujuan
        $gambar->move('file_upload/img', $fileName);
        // $gambar->storeAs('file_upload',$gambar->getClientOriginalName());

        $loker = new Loker;
        $loker->posisi = $request->posisi;
        $loker->kualifikasi = $request->kualifikasi;
        $loker->tgl_berakhir = Carbon::createFromFormat('d-m-Y', $request->tgl_berakhir)->format('Y-m-d');
        $loker->gambar = $fileName;

        // Membuat active non-active
        $active = "Active";
        $nonacive = "Non-active";
        if (Carbon::createFromFormat('d-m-Y', $request->tgl_berakhir)->format('Y-m-d') > now()) {
            $loker->status = $active;
        } else {
            $loker->status = $nonacive;
        }

        $loker->created_at = now();
        // dd($loker);
        $loker->save();

        return redirect('loker')->with('status', 'DATA LOKER BERHASIL DITAMBAH!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function show(Loker $loker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function edit(Loker $loker)
    {

        return view('loker.update-loker', compact('loker'), [
            "tittle" => "Update Loker"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loker $loker)
    {
        $request->validate([
            'gambar' => 'required|image|max:5024',
        ], [
            // PESAN ERROR
            'gambar.image' => 'File Harus Berformat Gambar!',
            'gambar.max' => 'File Terlalu Besar! Maximal 5 MB',
        ]);

        //mengambil data file yang diupload
        $gambar = $request->file('gambar');
        //mengambil nama file
        $fileName = $gambar->getClientOriginalName();
        //memindahkan file ke folder tujuan
        $gambar->move('file_upload/img', $fileName);
        // $gambar->storeAs('file_upload',$gambar->getClientOriginalName());

        $loker->posisi = $request->posisi;
        $loker->kualifikasi = $request->kualifikasi;
        $loker->tgl_berakhir = Carbon::createFromFormat('d-m-Y', $request->tgl_berakhir)->format('Y-m-d');
        $loker->gambar = $fileName;


        // Membuat active non-active
        $active = "Active";
        $nonacive = "Non-active";
        if (Carbon::createFromFormat('d-m-Y', $request->tgl_berakhir)->format('Y-m-d') > now()) {
            $loker->status = $active;
        } else {
            $loker->status = $nonacive;
        }



        $loker->updated_at = now();
        // dd($loker);
        $loker->save();

        return redirect('loker')->with('status', 'DATA LOKER BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loker  $loker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loker $loker)
    {
        $loker->delete();
        return redirect('loker')->with('status', 'DATA LOKER BERHASIL DIHAPUS!');
    }
}
