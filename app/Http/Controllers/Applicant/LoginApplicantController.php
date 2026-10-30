<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use App\Services\Applicant\LoginApplicantServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginApplicantController extends Controller
{
    protected $applicantServices;

    public function __construct(LoginApplicantServices $appserv)
    {
        $this->applicantServices = $appserv;
    }


    public function loginApplicant(Request $request)
    {
        $data = $this->applicantServices->login($request);

        switch ($data) {
            case 'Diizinkan':
                $user = Pelamar::where('kode_pelamar', $request->kode)->first();
                Auth::guard('pelamar')->login($user);

                return redirect()->route('applicant.home');
                break;

            case 'Tidak':
                return redirect()->back()->with('loginError', 'Anda Tidak Diizinkan!');
                break;

            default:
                return redirect()->back()->with('loginError', 'Akun Anda tidak ditemukan!');
                break;
        }
    }


    public function logoutApplicant(Request $request)
    {
        $pelamar = Pelamar::where('id_pelamar', Crypt::decrypt($request->data))->first();
        $pelamar->status = 'Selesai Tes';
        $pelamar->tgl_status = now();
        $pelamar->save();

        Auth::guard('pelamar')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('applicant.login');
    }


    public function home()
    {
        return view('home', [
            'title' => 'home'
        ]);
    }
}
