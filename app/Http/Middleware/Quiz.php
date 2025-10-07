<?php

namespace App\Http\Middleware;

use App\Models\Quiz as ModelsQuiz;
use Closure;
use Illuminate\Http\Request;

class Quiz
{

    public function handle(Request $request, Closure $next, ...$levels)
    {
        $tokens = ModelsQuiz::all();
        foreach ($tokens as $token) {
            if ($token->status == "is_active") {
                return $next($request);
            }
            abort(403, 'Sesi Pengerjaan Soal Sudah Berakhir');
        }


    }
}