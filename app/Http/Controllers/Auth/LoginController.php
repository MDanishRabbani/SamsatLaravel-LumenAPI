<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Menyimpan informasi login di sesi setelah pengguna berhasil login
    protected function authenticated(Request $request, $user)
    {
        session([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    // Menangani logout
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->forget(['email', 'password']); // Menghapus informasi login dari sesi
        return redirect('/'); // Redirect ke halaman yang diinginkan
    }
}
