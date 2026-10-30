<?php

namespace App\Services\Applicant;

use App\Models\Pelamar;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class LoginApplicantServices.
 */
class LoginApplicantServices
{
    public function login(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'password' => 'required|numeric|min_digits:8|max_digits:8',
            'captcha' => 'required|captcha',
        ], [
            // PESAN ERROR
            'captcha.captcha' => 'Captcha Yang Anda Masukan Salah!',
            'password.min_digits' => 'Kode dan Password Anda Salah',
            'password.max_digits' => 'Kode dan Password Anda Salah',
            'password.numeric' => 'Kode dan Password Anda Salah',
        ]);

        $date  = Carbon::createFromFormat('dmY', $request->password)->format('Y-m-d');

        $user = Pelamar::where('kode_pelamar', $request->kode)
            ->where('tgl_lahir', $date)->first();

        $userAccess = null;

        if ($user != null) {
            if ($user->status == 'Assesment/Psikotes') {
                $userAccess = 'Diizinkan';
            } else {
                $userAccess = 'Tidak';
            }
        } else {
            $userAccess = 'Null';
        }

        return $userAccess;
    }
}
