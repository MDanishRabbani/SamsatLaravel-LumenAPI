<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getVehicles(Request $request)
    {
        $vehicles = [
            [
                'id' => 1,
                'nama' => 'John Doe',
                'nik' => '1234567890123456',
                'nopol' => 'BL0909BNA',
                'rangka' => 'FR123456',
                'merk_tipe' => 'Yamaha/NMAX',
                'model' => 'NMAX 155',
                'warna' => 'Biru',
                'berlaku_sampai' => '2025-08-15',
                'pkb_5_tahun_berlaku_sampai' => '2028-08-15'
            ],
            [
                'id' => 2,
                'nama' => 'John Doe',
                'nik' => '1234567890123456',
                'nopol' => 'BL8560IDN',
                'rangka' => 'FR654321',
                'merk_tipe' => 'Honda/PCX',
                'model' => 'PCX 160',
                'warna' => 'Merah',
                'berlaku_sampai' => '2026-10-20',
                'pkb_5_tahun_berlaku_sampai' => '2029-10-20'
            ]
        ];

        $nik = $request->input('nik');
        $userVehicles = array_filter($vehicles, fn($vehicle) => $vehicle['nik'] === $nik);

        return response()->json(array_values($userVehicles));
    }
}
