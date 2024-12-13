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
                'id_transaksi' => 'TRX123456',
                'nama' => 'Agus Harahap',
                'nik' => '123456789012345',
                'nopol' => 'BL0909BNA',
                'rangka' => 'FR123456',
                'merk_tipe' => 'Yamaha/NMAX',
                'model' => 'NMAX 155',
                'warna' => 'Biru',
                'berlaku_sampai' => '2025-08-15',
                'pkb_5_tahun_berlaku_sampai' => '2028-08-15',
                'status' => 'Sudah Bayar',
                'no_bayar' => 'PAY123456',
                'kode_bayar' => 'KODE123',
                'tanggal_pembayaran' => '2023-08-10',
                'pengiriman' => 'JNE',
                'rincian_biaya_pajak' => [
                    'denda' => 50000,
                    'pajak_tahunan' => 500000,
                    'biaya_admin' => 5000,
                    'biaya_pengiriman' => 25000
                ],
                'total' => 580000,
                    'status_pembayaran' => 'berhasil',
            ],
            [
                'id' => 2,
                'id_transaksi' => 'TRX654321',
                'nama' => 'Agus Harahap',
                'nik' => '123456789012345',
                'nopol' => 'BL8560IDN',
                'rangka' => 'FR654321',
                'merk_tipe' => 'Honda/PCX',
                'model' => 'PCX 160',
                'warna' => 'Merah',
                'berlaku_sampai' => '2026-10-20',
                'pkb_5_tahun_berlaku_sampai' => '2029-10-20',
                'status' => 'Sudah Bayar',
                'no_bayar' => 'PAY654321',
                'kode_bayar' => 'KODE654',
                'tanggal_pembayaran' => '2023-09-12',
                'pengiriman' => 'SiCepat',
                'rincian_biaya_pajak' => [
                    'denda' => 75000,
                    'pajak_tahunan' => 600000,
                    'biaya_admin' => 5000,
                    'biaya_pengiriman' => 30000
                ],
                'total' => 710000,
                    'status_pembayaran' => 'berhasil',
            ],
            [
                'id' => 3,
                'id_transaksi' => 'TRX987654',
                'nama' => 'Agus Harahap',
                'nik' => '123456789012345',
                'nopol' => 'BL2231NT',
                'rangka' => 'FR6541232',
                'merk_tipe' => 'Toyota',
                'model' => 'Supra',
                'warna' => 'Merah',
                'berlaku_sampai' => '2026-10-20',
                'pkb_5_tahun_berlaku_sampai' => '2028-10-20',
                'status' => 'Sudah Bayar',
                'no_bayar' => 'PAY123456',
                'kode_bayar' => 'KODE987',
                'tanggal_pembayaran' => '2023-07-18',
                'pengiriman' => 'TIKI',
                'rincian_biaya_pajak' => [
                    'denda' => 50000,
                    'pajak_tahunan' => 500000,
                    'biaya_admin' => 5000,
                    'biaya_pengiriman' => 25000
                ],
                'total' => 580000,
                    'status_pembayaran' => 'berhasil',
            ],
            [
                'id' => 4,
                'id_transaksi' => 'TRX987655',
                'nama' => 'Donny Sumargo',
                'nik' => '023456789012345',
                'nopol' => 'BL2232NT',
                'rangka' => 'FR6541233',
                'merk_tipe' => 'Honda',
                'model' => 'Civic',
                'warna' => 'Hitam',
                'berlaku_sampai' => '2026-12-15',
                'pkb_5_tahun_berlaku_sampai' => '2028-12-15',
                'status' => 'Sudah Bayar',
                'no_bayar' => 'PAY123457',
                'kode_bayar' => 'KODE988',
                'tanggal_pembayaran' => '2023-08-10',
                'pengiriman' => 'JNE',
                'rincian_biaya_pajak' => [
                    'denda' => 60000,
                    'pajak_tahunan' => 600000,
                    'biaya_admin' => 7000,
                    'biaya_pengiriman' => 30000
                ],
                'total' => 690000,
                'status_pembayaran' => 'berhasil',
            ],
            
            [
                'id' => 5,
                'id_transaksi' => 'TRX987656',
                'nama' => 'Donny Sumargo',
                'nik' => '023456789012345',
                'nopol' => 'BL2233NT',
                'rangka' => 'FR6541234',
                'merk_tipe' => 'Suzuki',
                'model' => 'Swift',
                'warna' => 'Biru',
                'berlaku_sampai' => '2026-11-10',
                'pkb_5_tahun_berlaku_sampai' => '2028-11-10',
                'status' => 'Sudah Bayar',
                'no_bayar' => 'PAY123458',
                'kode_bayar' => 'KODE989',
                'tanggal_pembayaran' => '2023-09-05',
                'pengiriman' => 'POS',
                'rincian_biaya_pajak' => [
                    'denda' => 45000,
                    'pajak_tahunan' => 550000,
                    'biaya_admin' => 6000,
                    'biaya_pengiriman' => 20000
                ],
                'total' => 635000,
                'status_pembayaran' => 'berhasil',
            ],
            [
                'id' => 6,
                'id_transaksi' => 'TRX987657',
                'nama' => 'Jerome Jehian',
                'nik' => '223456789012345',
                'nopol' => 'BL2234NT',
                'rangka' => 'FR6541235',
                'merk_tipe' => 'BMW',
                'model' => 'X5',
                'warna' => 'Putih',
                'berlaku_sampai' => '2027-01-25',
                'pkb_5_tahun_berlaku_sampai' => '2029-01-25',
                'status' => 'Sudah Bayar',
                'no_bayar' => 'PAY123459',
                'kode_bayar' => 'KODE990',
                'tanggal_pembayaran' => '2023-10-12',
                'pengiriman' => 'JNE',
                'rincian_biaya_pajak' => [
                    'denda' => 70000,
                    'pajak_tahunan' => 800000,
                    'biaya_admin' => 8000,
                    'biaya_pengiriman' => 35000
                ],
                'total' => 910000,
                'status_pembayaran' => 'berhasil',
            ],
            
            [
                'id' => 7,
                'id_transaksi' => 'TRX987658',
                'nama' => 'Jerome Jehian',
                'nik' => '223456789012345',
                'nopol' => 'BL2235NT',
                'rangka' => 'FR6541236',
                'merk_tipe' => 'Mercedes',
                'model' => 'A-Class',
                'warna' => 'Abu-abu',
                'berlaku_sampai' => '2027-03-15',
                'pkb_5_tahun_berlaku_sampai' => '2029-03-15',
                'status' => 'Sudah Bayar',
                'no_bayar' => 'PAY123460',
                'kode_bayar' => 'KODE991',
                'tanggal_pembayaran' => '2023-11-05',
                'pengiriman' => 'TIKI',
                'rincian_biaya_pajak' => [
                    'denda' => 55000,
                    'pajak_tahunan' => 750000,
                    'biaya_admin' => 7500,
                    'biaya_pengiriman' => 30000
                ],
                'total' => 885000,
                'status_pembayaran' => 'berhasil',
            ]
            
        ];

        $nik = $request->input('nik');
        $nopol = $request->input('nopol');

        // Filter kendaraan berdasarkan NIK atau nopol
        $filteredVehicles = array_filter($vehicles, function ($vehicle) use ($nik, $nopol) {
            return ($nik && $vehicle['nik'] === $nik) || ($nopol && $vehicle['nopol'] === $nopol);
        });

        // Mengembalikan kendaraan yang sesuai dengan NIK atau nopol
        return response()->json(array_values($filteredVehicles));
    }

    public function getVehiclesOnly(Request $request)
{
    // Panggil VehicleController untuk mendapatkan data kendaraan berdasarkan request
    $vehicleController = new VehicleController();
    $vehiclesResponse = $vehicleController->getVehicles($request);
    $vehicles = json_decode($vehiclesResponse->getContent(), true);

    if (!empty($vehicles)) {
        // Ambil hanya properti tertentu dari setiap kendaraan
        $vehicleOnly = array_map(function ($vehicle) {
            return [
                'nama' => $vehicle['nama'],
                'nik' => $vehicle['nik'],
                'nopol' => $vehicle['nopol'],
                'rangka' => $vehicle['rangka'],
                'merk_tipe' => $vehicle['merk_tipe'],
                'model' => $vehicle['model'],
                'warna' => $vehicle['warna'],
                'berlaku_sampai' => $vehicle['berlaku_sampai'],
                'pkb_5_tahun_berlaku_sampai' => $vehicle['pkb_5_tahun_berlaku_sampai']
            ];
        }, $vehicles);

        return response()->json($vehicleOnly);
    }

    return response()->json([]);
}

}
