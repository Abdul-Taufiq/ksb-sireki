<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Loker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class PelamarController extends Controller
{
    public function dashboard()
    {
        $currentDate = Carbon::now();
        DB::table('tb_loker')
            ->where('tgl_berakhir', '<', $currentDate)
            ->update(['status' => 'Non-active']);

        $loker = Loker::where('status', 'Active')->paginate(6);
        if (!$loker->isEmpty()) {
            return view('notloged.dashboard', compact('loker'), [
                "tittle" => "Dashboard"
            ]);
        } else {
            return view('notloged.dashboard-disloker', compact('loker'), [
                "tittle" => "Dashboard"
            ]);
        };
    }

    public function index()
    {
        $data = Pelamar::orderBy('created_at', 'DESC')->get();
        return view('pelamar.pelamar', compact('data'), [
            "tittle" => "Pelamar"
        ]);
    }


    public function updateStatus(Request $request)
    {
        $ids = base64_decode($request->id_pelamar);
        $pelamar = Pelamar::find($ids);
        $pelamar->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
            'nama_status' => Auth::user()->nama,
            'tgl_status' => now()
        ]);

        return redirect()->back()->with('status', 'Status Pelamar Berhasil Diupdate!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loker = Loker::where('status', 'Active')->get();
        $now = Carbon::now();
        return view('notloged.add-pelamar', compact('loker'), [
            "tittle" => "Daftar Karir"
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
            'berkas_pendukung' => 'required|mimes:pdf|max:10240',
            'no_telp' => 'numeric|min:0000011111|max:999999999999999',
            'no_wa' => 'numeric|min:0000011111|max:999999999999999',
        ], [
            // PESAN ERROR
            'berkas_pendukung.mimes' => 'File Harus Berformat PDF!',
            'berkas_pendukung.max' => 'File Terlalu Besar! Maximal 10 MB',
            'no_telp.numeric' => 'Nomor Hp Harus Angka',
            'no_telp.min' => 'Nomor Hp Harus Minimal 10 Angka',
            'no_telp.max' => 'Nomor Hp Harus Maximal 14 Angka',
        ]);


        // berkas_pendukung
        //mengambil data file yang diupload
        $berkas_pendukung = $request->file('berkas_pendukung');
        //mengambil nama file
        $fileNameberkas_pendukung = $berkas_pendukung->getClientOriginalName();
        //memindahkan file ke folder tujuan
        $berkas_pendukung->move('file_upload/pdf', $fileNameberkas_pendukung);
        // $pdf->storeAs('file_upload',$pdf->getClientOriginalName());

        $pelamar = new Pelamar;
        $pelamar->nama = $request->nama;
        $pelamar->tempat_lahir = $request->tempat_lahir;
        $pelamar->tgl_lahir = Carbon::createFromFormat('d-m-Y', $request->tgl_lahir)->format('Y-m-d');
        $pelamar->alamat = $request->alamat;
        $pelamar->domisili = $request->domisili;
        $pelamar->jns_kelamin = $request->jns_kelamin;
        $pelamar->email = $request->email;
        $pelamar->no_telp = $request->no_telp;
        $pelamar->no_wa = $request->no_wa;
        $pelamar->posisi = $request->posisi;
        $pelamar->pendidikan = $request->pendidikan;
        $pelamar->jurusan = $request->jurusan;
        $pelamar->berkas_pendukung = $fileNameberkas_pendukung;

        $pelamar->created_at = now();
        // dd($pelamar);
        $pelamar->save();

        return redirect('calon/create')->with('status', 'DATA ANDA BERHASIL DIKIRIMKAN!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelamar  $pelamar
     * @return \Illuminate\Http\Response
     */
    public function show(Pelamar $pelamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelamar  $pelamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelamar $pelamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelamar  $pelamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelamar $pelamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelamar  $pelamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelamar $pelamar)
    {
        $pelamar->delete();
        return redirect('pelamar')->with('status', 'DATA PELAMAR BERHASIL DIHAPUS!');
    }
}
