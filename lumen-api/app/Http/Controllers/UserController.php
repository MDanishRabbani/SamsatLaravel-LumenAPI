<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Dummy login data
        $users = [
            ['email' => 'user@example.com', 'pin' => '1234', 'nik' => '1234567890123456']
        ];

        // Check login credentials
        foreach ($users as $user) {
            if ($user['email'] === $request->input('email') && $user['pin'] === $request->input('pin')) {
                return response()->json(['NIK' => $user['nik']]);
            }
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
