<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class BasicAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Cek apakah ada header Authorization
        if (!$request->headers->has('Authorization')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Ambil token dari header Authorization
        $authHeader = $request->headers->get('Authorization');
        if (preg_match('/Basic (.+)/', $authHeader, $matches)) {
            // Decode kredensial
            $credentials = explode(':', base64_decode($matches[1]));
            $usernameOrEmail = $credentials[0]; // Bisa username atau email
            $password = $credentials[1]; // Password

            // Cek kredensial di database
            $user = DB::table('users')->where(function ($query) use ($usernameOrEmail) {
                $query->where('email', $usernameOrEmail)
                      ->orWhere('name', $usernameOrEmail);
            })->first();

            if ($user && password_verify($password, $user->password)) {
                // Jika otentikasi berhasil, lanjutkan permintaan
                return $next($request);
            }
        }

        // Jika otentikasi gagal, kembalikan response 401 Unauthorized
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
