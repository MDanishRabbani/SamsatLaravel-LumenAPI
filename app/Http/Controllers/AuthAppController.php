<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class AuthAppController extends Controller
{
    // API Login: Mengirimkan PIN ke email
    public function login(Request $request)
    {
        // Validasi input
    $this->validate($request, [
      'email' => 'required|email',
  ]);

  // Cari pengguna berdasarkan email
  $user = \DB::table('users_app')->where('email', $request->email)->first();

  if (!$user) {
    return response()->json(['status' => 'failed', 'message' => 'email tidak terdaftar, cek apakah email benar atau silahkan daftar dahulu'], 404);
}


  // Generate PIN baru
  $pin = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

  // Simpan PIN di database
  \DB::table('users_app')
      ->where('email', $request->email)
      ->update(['pin' => $pin]);

  // Kirim email dengan PIN
  Mail::send('email.auth_pin', ['pin' => $pin], function ($message) use ($user) {
    $message->to($user->email)
            ->subject('Konfirmasi PIN Login');
});

  return response()->json(['status' => 'success', 'message' => 'PIN telah dikirimkan ke email anda'], 200);
  }

    public function verifyPin(Request $request)
{
    $this->validate($request, [
        'email' => 'required|email',
        'pin' => 'required',
    ]);

    // Cek apakah email dan PIN cocok
    $user = \DB::table('users_app')
        ->where('email', $request->email)
        ->where('pin', $request->pin)
        ->first();

    if (!$user) {
        return response()->json(['message' => 'Email atau PIN salah!'], 401);
    }

    return response()->json(['nik' => $user->nik], 200);
}

public function register(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'nik' => 'required|unique:users_app,nik|max:16',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'alamat_ktp' => 'required',
            'nomor_hp' => 'required|unique:users_app,nomor_hp|max:15',
            'email' => 'required|email|unique:users_app,email|max:100',
        ]);

        // Masukkan data ke database
        $user = \DB::table('users_app')->insert([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat_ktp' => $request->alamat_ktp,
            'nomor_hp' => $request->nomor_hp,
            'email' => $request->email,
            'pin' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT), // Generate PIN
        ]);

        return response()->json(['message' => 'User registered successfully!'], 201);
    }

}
