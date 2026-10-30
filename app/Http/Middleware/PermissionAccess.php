<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PermissionTokens;
use Carbon\Carbon;

class PermissionAccess
{

    public function handle(Request $request, Closure $next, ...$levels)
    {
        $data = PermissionTokens::first();

        $now = Carbon::now()->format('Y-m-d');
        if (
            $data->status == "is_active" && $data->date >= $now &&
            $data->token_id == "28c8edde3d61a0411511" &&
            $data->token_type == "28c8edde3d61a0411511"
        ) {
            return $next($request);
        }

        $data->token_id == "28c8edde3d61a0411511PE";
        $data->token_type == "28c8edde3d61a0411511PE";
        $data->updated_at = now();
        $data->save();
        abort(229, '!View Permission Access');
    }
}
