<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelamar;
use App\Models\Loker;
use App\Models\Penjadwalan;
use App\Models\PermissionTokens;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // update permission
        PermissionTokens::where('id', '1')->update([
            'updated_at' => now()
        ]);


        $User = User::all();
        $pelamar = Pelamar::all();
        $lokerActive = Loker::all()->where('status', '=', 'Active');
        $lokerNonactive = Loker::all()->where('status', '=', 'Non-active');

        return view('home', compact('User', 'pelamar', 'lokerActive', 'lokerNonactive'), [
            "title" => "Dashboard"
        ]);
    }
}
