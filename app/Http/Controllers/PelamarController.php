<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Loker;
use App\Models\Quiz\Jadwal;
use App\Models\Quiz\JadwalXPelamar;
use App\Models\Quiz\PaketSoal;
use App\Models\TrackingLamaran;
use App\Services\PelamarServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Str;

class PelamarController extends Controller
{
    protected $pelamarServices;
    public function __construct(PelamarServices $pelamarServices)
    {
        $this->pelamarServices = $pelamarServices;
    }


    // =========================
    // PUBLIC
    public function dashboard()
    {
        $currentDate = Carbon::now();
        Loker::where('tgl_berakhir', '<', $currentDate)
            ->update(['status' => 'Non-active']);

        $loker = Loker::where('status', 'Active')->paginate(9);
        return view('notloged.dashboard', compact('loker'), [
            "title" => "Dashboard"
        ]);
    }


    public function dashboardShow($id)
    {
        $ids = base64_decode($id);
        $loker = Loker::findOrFail($ids);
        return view('notloged.detail-loker', compact('loker'), [
            "title" => "Detail Lowongan"
        ]);
    }


    public function showData($id)
    {
        $ids = Crypt::decrypt($id);
        $pelamar = Pelamar::findOrFail($ids);
        return view('notloged.show-pelamar', compact('pelamar'), [
            "title" => "Detail Kandidat & Lamaran Pekerjaan"
        ]);
    }


    public function getDataPelamar(Request $request)
    {
        $kodeLamaran = $request->input('kode');
        $password = $request->input('pass');

        $date  = Carbon::createFromFormat('dmY', $password)->format('Y-m-d');


        // Cari pelamar berdasarkan kode lamaran dan password
        $pelamar = Pelamar::where('kode_pelamar', $kodeLamaran)
            ->where('tgl_lahir', $date)
            ->first();

        if ($pelamar) {
            // Jika pelamar ditemukan, kembalikan data pelamar
            return response()->json([
                'success' => true,
                'data' =>  Crypt::encrypt($pelamar->id_pelamar)
            ]);
        } else {
            // Jika pelamar tidak ditemukan, kembalikan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Data pelamar tidak ditemukan.'
            ]);
        }
    }



    public function create($id)
    {
        $ids = base64_decode($id);
        $loker = Loker::findOrFail($ids);

        return view('notloged.add-pelamar', compact('loker'), [
            "title" => "Apply Loker KSB",
            'loker' => $loker
        ]);
    }


    public function store(Request $request)
    {
        $pelamar = $this->pelamarServices->store($request);

        return redirect()->route('pelamar-show', encrypt($pelamar->id_pelamar))->with('AlertSuccess', 'DATA LAMARAN BERHASIL DIKIRIM!');
    }


    // ============================
    // ADMIN
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->pelamarServices->index($request);
        }

        $paket = PaketSoal::orderBy('created_at', 'desc')->get();

        return view('page.pelamar.index', [
            "title" => "Data Pelamar",
            'paket' => $paket
        ]);
    }


    public function show($id)
    {
        $ids = base64_decode($id);
        $pelamar = Pelamar::with('tracking')->findOrFail($ids);

        return view('page.pelamar.show', compact('pelamar'), [
            "title" => "Detail Kandidat & Lamaran Pekerjaan"
        ]);
    }


    public function update($id, Request $request)
    {
        $pelamar = Pelamar::findOrFail(base64_decode($id));
        $pelamar->kode_pelamar = $request->kode_pelamar;
        $pelamar->save();

        return redirect()->back();
    }


    public function destroy($id)
    {
        $pelamar = Pelamar::findOrFail(base64_decode($id));

        // hapus file gambar lama
        if ($pelamar->berkas_pendukung) {
            $path = public_path('file_upload/pdf/' . $pelamar->berkas_pendukung);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $pelamar->delete();
        // return redirect('pelamar')->with('status', 'DATA PELAMAR BERHASIL DIHAPUS!');
        return response()->json(['success' => true]);
    }


    // Update status pelamar
    public function changeStatus(Request $request)
    {
        $this->pelamarServices->changeStatus($request);
        return redirect()->back()->with('AlertSuccess', 'Status Pelamar Berhasil Diupdate!');
    }
}
