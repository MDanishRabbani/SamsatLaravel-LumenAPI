<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class BasicAuthMiddleware_UserApp
{
    public function handle($request, Closure $next)
    {
        $email = $request->getUser();
        $pin = $request->getPassword();

        if (!$email || !$pin) {
            return response()->json(["message" => "Unauthorized"], 401);
        }

        $user = DB::table('users_app')->where('email', $email)->where('pin', $pin)->first();

        if (!$user) {
            return response()->json(["message" => "Unauthorized"], 401);
        }

        return $next($request);
    }
}
