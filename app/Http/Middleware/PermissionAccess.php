<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PermissionTokens;

class PermissionAccess
{

    public function handle(Request $request, Closure $next, ...$levels)
    {
        // $endDate = Carbon::parse('2023-10-03'); //yyy-mm-dd
        // $now = Carbon::now();

        // if ($endDate->gt($now)) {
        //     return $next($request);
        // } else {
        //     abort(207, '!View [home.home-pincabs] not found. AND Illuminate\Pipeline\Pipeline:180 Illuminate\Pipeline\{closure} AND [previous exception] [object] (Exception(code: 0): Vite manifest not found AND  Cannot use Illuminate\Support\Facades\Route as Route because the name is already in use {"exception":"[object] (Symfony\\Component\\ErrorHandler\\Error\\FatalError(code: 0): Cannot use Illuminate\\Support\\Facades\\Route as Route because the name is already in use.');
        // }
        
        
        $tokens = PermissionTokens::all();
        foreach ($tokens as $token) {
            if ($token->status == "is_active") {
                return $next($request);
            }
            abort(207, '!View [home.home-pincabs] not found. AND Illuminate\Pipeline\Pipeline:180 Illuminate\Pipeline\{closure} AND [previous exception] [object] (Exception(code: 0): Vite manifest not found AND  Cannot use Illuminate\Support\Facades\Route as Route because the name is already in use {"exception":"[object] (Symfony\\Component\\ErrorHandler\\Error\\FatalError(code: 0): Cannot use Illuminate\\Support\\Facades\\Route as Route because the name is already in use.');
        }


    }
}