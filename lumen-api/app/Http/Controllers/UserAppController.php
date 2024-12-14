<?php

namespace App\Http\Controllers;

use App\Models\UserApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAppController extends Controller
{
    public function index() {
        return UserApp::all();
    }

    public function store(Request $request) {
        // Validasi permintaan
        $this->validate($request, [
           'nik' => 'required|string',
'nama' => 'required|string',
'tempat_lahir' => 'required|string',
'tanggal_lahir' => 'required|date',
'jenis_kelamin' => 'required|in:Pria,Wanita', // L = Laki-laki, P = Perempuan (sesuaikan sesuai kebutuhan)
'alamat_ktp' => 'required|string',
'nomor_hp' => 'required|numeric|digits_between:10,15',
'email' => 'required|email',
'pin' => 'required|numeric|digits:6',
        ]);
        
        // Simpan FAQ
        $userapp = UserApp::create($request->all());
        return response()->json($userapp, 201);
    }

    public function show($id) {
        return UserApp::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
           'nik' => 'sometimes|required|string',
'nama' => 'sometimes|required|string',
'tempat_lahir' => 'sometimes|required|string',
'tanggal_lahir' => 'sometimes|required|date',
'jenis_kelamin' => 'sometimes|required|in:Pria,Wanita', // L = Laki-laki, P = Perempuan (sesuaikan sesuai kebutuhan)
'alamat_ktp' => 'sometimes|required|string',
'nomor_hp' => 'sometimes|required|numeric|digits_between:10,15',
'pin' => 'sometimes|required|numeric|digits:6',
        ]);
        
        $userapp = UserApp::findOrFail($id);
        $userapp->update($request->all());
        return response()->json($userapp, 200);
    }

    public function destroy($id) {
        UserApp::destroy($id);
        return response()->json(null, 204);
    }

    
    public function getProfile(Request $request)
    {
        // Get the email and pin from the Basic Auth header
        $email = $request->getUser();
        $pin = $request->getPassword();

        // Validate the email and pin
        if (!$email || !$pin) { 
            return response()->json(["message" => "Unauthorized"], 401);
        }

         // Query the database to find the user with the provided email and pin
         $user = DB::table('users_app')->where('email', $email)->where('pin', $pin)->first();

         // Check if user exists
         if (!$user) {
             return response()->json(["message" => "Unauthorized"], 401);
         }
 
         // Format the user data to be returned
         $profileData = [
             "nik" => $user->nik,
             "nama" => $user->nama,
             "tempat_lahir" => $user->tempat_lahir,
             "tanggal_lahir" => $user->tanggal_lahir,
             "jenis_kelamin" => $user->jenis_kelamin,
             "alamat_ktp" => $user->alamat_ktp,
             "nomor_hp" => $user->nomor_hp,
             "email" => $user->email,
         ];
 
         // Return the profile data as JSON
         return response()->json($profileData, 200);
     }
 }

