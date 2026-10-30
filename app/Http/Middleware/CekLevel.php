<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekLevel
{
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (!$request->user()) {
            return redirect('/home'); // belum login
        }

        if (in_array($request->user()->level, $levels)) {
            return $next($request); // level cocok
        }

        // kalau level tidak cocok, blokir
        return redirect()->back()->with('AlertFail', 'Anda tidak punya akses!');
    }
}
