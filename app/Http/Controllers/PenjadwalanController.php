<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\Loker;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penjadwalan::all();
        return view ('penjadwalan.penjadwalan', compact('data'), [
            "tittle" => "Penjadwalan"
        ],
        [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $pelamar = Pelamar::all();
        $loker = Loker::all();
        return view('penjadwalan.add-penjadwalan', compact('pelamar', 'loker'), [
            "tittle" => "Tambah Data Penjadwalan Baru"
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
            'pic_telp' => 'required|min:10|numeric',
        ], [
            // PESAN ERROR
            'pic_telp.min' => 'Nomor Telephone Minimal 10!',
            'pic_telp.numeric' => 'Inputan Harus Berformat Numbering',
        ]);

        $penjadwalan = new Penjadwalan;
        $penjadwalan->id_pelamar = $request->id_pelamar ;
        $penjadwalan->id_loker = $request->id_loker ;
        $penjadwalan->tgl_test = Carbon::createFromFormat('d-m-Y', $request->tgl_test)->format('Y-m-d');
        $penjadwalan->jam = $request->jam ;
        $penjadwalan->keterangan = $request->keterangan ;
        $penjadwalan->tempat = $request->tempat ;
        $penjadwalan->pic = $request->pic ;
        $penjadwalan->pic_telp = $request->pic_telp ;
        $penjadwalan->created_at = now() ;
        // dd($penjadwalan);
        $penjadwalan->save();

        return redirect('penjadwalan')->with('status', 'DATA PENJADWALAN BERHASIL DITAMBAH!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjadwalan $penjadwalan)
    {
        $now = Carbon::now();
        $pelamar = Pelamar::all();
        $loker = Loker::all();
        return view('penjadwalan.update-penjadwalan', compact('pelamar', 'loker', 'penjadwalan'), [
            "tittle" => "Update Data Penjadwalan"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjadwalan $penjadwalan)
    {
        $request->validate([
            'pic_telp' => 'required|min:10|numeric',
        ], [
            // PESAN ERROR
            'pic_telp.min' => 'Nomor Telephone Minimal 10!',
            'pic_telp.numeric' => 'Inputan Harus Berformat Numbering',
        ]);

        $penjadwalan->id_pelamar = $request->id_pelamar ;
        $penjadwalan->id_loker = $request->id_loker ;
        $penjadwalan->tgl_test = Carbon::createFromFormat('d-m-Y', $request->tgl_test)->format('Y-m-d');
        $penjadwalan->jam = $request->jam ;
        $penjadwalan->keterangan = $request->keterangan ;
        $penjadwalan->tempat = $request->tempat ;
        $penjadwalan->pic = $request->pic ;
        $penjadwalan->pic_telp = $request->pic_telp ;
        $penjadwalan->updated_at = now() ;
        // dd($penjadwalan);
        $penjadwalan->save();

        return redirect('penjadwalan')->with('status', 'DATA PENJADWALAN BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjadwalan $penjadwalan)
    {
        $penjadwalan->delete();
        return redirect('penjadwalan')->with('status', 'DATA PENJADWALAN BERHASIL DIHAPUS!');
    }
}
