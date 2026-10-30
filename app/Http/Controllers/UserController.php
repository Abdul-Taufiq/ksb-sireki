<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $data = User::all();
        // dd($data);
        return view(
            'user.user',
            compact('data'),
            [
                "title" => "Data User"
            ],
            [
                'data' => $data
            ]
        );
    }


    public function create()
    {
        $now = Carbon::now();
        return view('debitur.add-debitur', [
            "title" => "Tambah Data User"
        ]);
    }


    public function edit(User $user)
    {
        $data = User::all();
        return view(
            'user.update-user',
            compact('user', 'data'),
            [
                "title" => "Edit User"
            ],
            [
                'data' => $data
            ]
        );
    }

    public function update(Request $request, $id)
    {
        // FORM VALIDASI
        $request->validate([
            'nama' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            // PESAN ERROR
            'nama.min' => 'Nama Minimal 2 Karakter!',
            'nama.max' => 'Nama Maksimal 255 Karakter!',
            'email.email' => 'Email Yang Anda Masukan Tidak Valid!',
            'email.unique' => 'Email Tidak Bisa Digunakan!',
            'password.min' => 'Password Minimal 8 Karakter!',
            'password.confirmed' => 'Konfirmasi Password Tidak Cocok!',
        ]);

        DB::table('users')->where('id', $id)
            ->update([
                'nama' => $request['nama'],
                'email' => $request['email'],
                'level' => $request['level'],
                // menggunakan enkripsi jenis BCrypt
                'password' => Hash::make($request['password']),
                'updated_at' => now(),
                // menggunakan md5
                // 'password' => md5($data['password']),
            ]);


        return redirect('user')->with('status', 'DATA USER BERHASIL DIUBAH!');
    }


    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('user')->with('status', 'DATA USER BERHASIL DIHAPUS!');
    }
}
