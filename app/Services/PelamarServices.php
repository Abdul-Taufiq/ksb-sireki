<?php

namespace App\Services;

use App\Models\Pelamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Models\Loker;
use App\Models\Quiz\Jadwal;
use App\Models\Quiz\JadwalXPelamar;
use App\Models\TrackingLamaran;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class PelamarServices.
 */
class PelamarServices
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $awal = Carbon::parse($request->min)->startOfDay();
        $akhir = Carbon::parse($request->max)->endOfDay();


        if ($request->ajax()) {
            // query
            $query = Pelamar::whereNotNull('nama');

            // Filter
            if (!empty($request->min)) {
                $data = $query->whereBetween('created_at', [$awal, $akhir]);
            } else {
                $data = $query;
            }

            // filter cabang
            if (!empty($request->id_cabang) && $request->id_cabang != 99) {
                $data = $query->where('id_cabang', $request->id_cabang);
            } else {
                if (auth()->user()->level == 'MEDIUM USER') {
                    $data = $query->where('id_cabang', $user->id_cabang);
                } else {
                    $data = $query;
                }
            }

            // filter status_filter
            if (!empty($request->status_filter)) {
                $data = $query->where('status', $request->status_filter);
            } else {
                $data = $query;
            }


            // return ke data table
            return DataTables::of($data)
                ->addColumn('cabang', function ($data) {
                    return $data->cabang->cabang ?? 'ALL CABANG';
                })
                ->addColumn('status', function ($data) use ($user) {
                    $statusDropdown = $this->statusNothing($data);

                    $status = '';
                    switch ($user->jabatan) {
                        case 'Kasi Operasional':
                        case 'Kasi Komersial':

                        case 'Pimpinan Cabang':
                            if ($data->kategori == 'Dibawah Kasi') {
                                $statusAfter = $this->statusAfter($data->status_akhir, $statusDropdown);
                                return $statusAfter;
                            } else {
                                $status .= '<a class="btn btn-info btn-sm disabled">NotNeed</a>';
                            }

                            break;

                        case 'SDM':
                            $statusAfter = $this->statusAfter($data->status_akhir, $statusDropdown);
                            return $statusAfter;
                            break;
                        default:
                            $status .= '<a class="btn btn-info btn-sm disabled">NotNeed</a>';
                            break;
                    }

                    return $status;
                })
                ->addColumn('action', function ($data) use ($user) {
                    $button = '<a data-bs-toggle="modal" data-bs-target="#myModal" 
                                    id="' . base64_encode($data->id_pelamar) . '" 
                                    class="btn btn-info btn-sm detail_data btn-table" 
                                    data-kode="' . $data->nama . '">
                                    <i class="bi bi-eye-fill"></i>
                                </a>';

                    switch ($user->jabatan) {
                        case 'TSI':
                        case 'SDM':
                            // $button .= '<a href="' . route('applicant.edit', base64_encode($data->id_pelamar)) . '"
                            //                 class="btn btn-warning btn-sm edit btn-table">
                            //                 <span class="icon text-center">
                            //                     <i class="bi bi-pencil-square"></i>
                            //                 </span>
                            //             </a>';
                            $button .= '
                                <a data-id="' . base64_encode($data->id_pelamar) . '"
                                    class="btn btn-danger btn-sm delete-btn btn-table">
                                    <span class="icon text-center">
                                        <i class="bi bi-trash"></i>
                                    </span>
                                </a>
                            ';
                            break;

                        default:
                            $button .= '<a class="btn btn-danger btn-sm delete-btn btn-table disabled">
                                    <span class="icon text-center">
                                        <i class="bi bi-trash"></i>
                                    </span></a>';
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
        $loker = Loker::findOrFail(Crypt::decrypt($request->id_loker));

        // biking kode unik untuk pelamar
        $uniqueCode = implode('-', [
            Str::random(6),
            // Str::random(6),
            //     Str::random(6),
        ]);

        $existingCode = Pelamar::where('kode_pelamar', $uniqueCode)->exists();
        while ($existingCode) {
            $uniqueCode = implode('-', [
                Str::random(6),
                // Str::random(6),
                // Str::random(6),
            ]);
            $existingCode = Pelamar::where('kode_pelamar', $uniqueCode)->exists();
        }

        // pecah nama depan
        $pecah_nama = explode(' ', $request->nama_lengkap);
        $nama_depan = $pecah_nama[0];
        // gabung
        $kode = $nama_depan . '-' . $uniqueCode;

        // berkas_pendukung
        //mengambil data file yang diupload
        $berkas_pendukung = $request->file('berkas_pendukung');
        //mengambil nama file
        $fileNameberkas_pendukung = $request->nama_lengkap
            . '-' . $request->tempat_lahir
            . '-' .  Carbon::parse($request->tgl_lahir)->format('dMY')
            . '-' . now()->format('dMY-Hi')
            . '-' . $berkas_pendukung->getClientOriginalExtension();
        //memindahkan file ke folder tujuan
        $berkas_pendukung->move('file_upload/pdf', $fileNameberkas_pendukung);
        // $pdf->storeAs('file_upload',$pdf->getClientOriginalName());

        $pelamar = new Pelamar;
        $pelamar->id_cabang = $request->id_cabang;
        $pelamar->nama = $request->nama_lengkap;
        $pelamar->tempat_lahir = $request->tempat_lahir;
        $pelamar->tgl_lahir = $request->tgl_lahir;
        $pelamar->alamat = $request->alamat;
        $pelamar->domisili = $request->alamat_domisili;
        $pelamar->jns_kelamin = $request->jns_kelamin;
        $pelamar->email = $request->email;
        $pelamar->no_telp = $request->no_hp;
        $pelamar->kategori = $loker->kategori;
        $pelamar->posisi = $loker->posisi;
        $pelamar->pendidikan = $request->pendidikan;
        $pelamar->jurusan = $request->jurusan;
        $pelamar->berkas_pendukung = $fileNameberkas_pendukung;
        $pelamar->kode_pelamar = $kode;
        $pelamar->created_at = now();
        $pelamar->save();

        try {
            Mail::send('email.notif-pelamar',  [
                'nama' => $pelamar->nama,
                'kode_pelamar' => $pelamar->kode_pelamar,
                'tgl_lahir' => $pelamar->tgl_lahir,
                'posisi' => $pelamar->posisi,
                'created' => $pelamar->created_at,
            ], function ($message) use ($pelamar) {
                $message->from(config('mail.from.address'), 'No-Reply | KSB');
                $message->to($pelamar->email);
                $message->subject('Pemberitahuan Rekruitmen!');
            });
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim Email Notification', [
                'email' => $pelamar->email,
                'message' => $e->getMessage(),
            ]);
        }

        return $pelamar;
    }


    // Update status pelamar
    public function changeStatus(Request $request)
    {
        // dd($request);
        $pelamar = Pelamar::findOrFail(Crypt::decrypt($request->id_pelamar));
        $pelamar->id_paket_soal = $request->status == 'Assesment/Psikotes' ? $request->paket_soal : null;
        $pelamar->status = $request->status;
        $pelamar->catatan = $request->catatan;
        $pelamar->tgl_status = now();
        if ($request->status == 'Tidak Lolos Seleksi') {
            $pelamar->status_akhir = 'DITOLAK';
        } elseif ($request->status == 'Offering/Finalisasi') {
            $pelamar->status_akhir = 'DISETUJUI';
        } else {
            $pelamar->status_akhir = 'PROSES';
        }
        $pelamar->save();

        if ($request->jadwalkan == 'Ya') {
            // jadwal
            $jadwal = new Jadwal();
            $jadwal->kegiatan = $request->status;
            $jadwal->tgl_jadwal = $request->tgl_jadwal;
            $jadwal->keterangan = $request->keterangan;
            $jadwal->save();

            // pivot jadwal x pelamar
            $pivot = new JadwalXPelamar();
            $pivot->id_pelamar = $pelamar->id_pelamar;
            $pivot->id_jadwal = $jadwal->id;
            $pivot->save();
        }

        // tracking
        $tracking = new TrackingLamaran();
        $tracking->id_pelamar = $pelamar->id_pelamar;
        $tracking->nama = auth()->user()->nama;
        $tracking->jabatan = auth()->user()->jabatan;
        $tracking->status = $request->status;
        $tracking->tgl_status = now();
        $tracking->save();
    }


    public function statusNothing($data)
    {
        $class = 'secondary';
        if ($data->status_akhir == null) {
            $class = 'secondary';
        } elseif ($data->status_akhir == 'PROSES') {
            $class = 'warning';
        }

        $status = '';
        $status .= '<div class="dropdown">';
        $status .= '<button class="btn btn-' . ($data->status_akhir == null ? 'secondary' : 'warning')  . ' btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
        $status .= $data->status ?? 'Nothing';
        $status .= '</button>';
        $status .= '<ul class="dropdown-menu">';
        $status .= '<button class="dropdown-item changeStatus btn" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="'
            . encrypt($data->id_pelamar)
            . '" data-kode="' . $data->nama . '">Change Status</button>';
        $status .= '</ul>';
        $status .= '</div>';

        $status .= '</div>';
        return $status;
    }


    public function statusAfter($status_akhir, $statusDropdown)
    {
        $status = '';
        switch ($status_akhir) {
            case null:
            case 'PROSES':
                $status =  $statusDropdown;
                break;

            case 'DISETUJUI':
                $status .= '<a class="btn btn-success btn-sm disabled">DISETUJUI</a>';
                break;

            case 'DITOLAK':
                $status .= '<a class="btn btn-danger btn-sm disabled">DITOLAK</a>';
                break;

            default:
                $status .= '<a class="btn btn-secondary btn-sm disabled">NOTNEED</a>';
                break;
        }

        return $status;
    }

    // Log activity
    // public function LogActivity($data, $LogAksi)
    // {
    //     $log = new LogActivity();
    //     $log->id_cabang = auth()->user()->id_cabang;
    //     $log->nama = auth()->user()->nama;
    //     $log->email = auth()->user()->email;
    //     $log->level = auth()->user()->jabatan;
    //     $log->aksi = $LogAksi;
    //     $log->kode_form = $data->kode_form;
    //     $log->created_at = now();
    //     $log->save();
    // }
}
