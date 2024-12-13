<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Endpoint to retrieve payment details based on vehicle information.
     */
    public function getPaymentDetails(Request $request)
    {
        $nopol = $request->input('nopol');

        // Panggil VehicleController untuk mendapatkan data kendaraan berdasarkan nopol
        $vehicleController = new VehicleController();
        $request->merge(['nopol' => $nopol]);
        $vehiclesResponse = $vehicleController->getVehicles($request);
        $vehicles = json_decode($vehiclesResponse->getContent(), true);

        if (!empty($vehicles)) {
            // Ambil kendaraan pertama yang sesuai dengan nopol
            $vehicle = $vehicles[0];
            $paymentDetails = [
                'no_bayar' => $vehicle['no_bayar'],
                'rincian_biaya_pajak' => $vehicle['rincian_biaya_pajak'],
                'total' => $vehicle['total']
            ];
            return response()->json($paymentDetails);
        } else {
            return response()->json(['error' => 'No payment details found for the provided nopol'], 404);
        }
    }

    /**
     * Endpoint to retrieve payment history based on NIK.
     */
    public function getPaymentHistory(Request $request)
    {
        $nik = $request->input('nik');

        // Panggil VehicleController untuk mendapatkan data kendaraan berdasarkan nik
        $vehicleController = new VehicleController();
        $request->merge(['nik' => $nik]);
        $vehiclesResponse = $vehicleController->getVehicles($request);
        $vehicles = json_decode($vehiclesResponse->getContent(), true);

        if (!empty($vehicles)) {
            // Ambil histori pembayaran dari semua kendaraan yang cocok
            $paymentHistory = array_map(function ($vehicle) {
                return [
                    'id' => $vehicle['id'],
                    'nik' => $vehicle['nik'],
                    'nopol' => $vehicle['nopol'],
                    'status' => $vehicle['status'],
                    'no_bayar' => $vehicle['no_bayar'],
                    'total' => $vehicle['total']
                ];
            }, $vehicles);

            return response()->json($paymentHistory);
        } else {
            return response()->json(['error' => 'No payment history found for the provided NIK'], 404);
        }
    }

    /**
     * Endpoint to retrieve detailed payment history based on vehicle information.
     */
    public function getPaymentDetailHistory(Request $request)
    {
        $nopol = $request->input('nopol');

        // Panggil VehicleController untuk mendapatkan data kendaraan berdasarkan nopol
        $vehicleController = new VehicleController();
        $request->merge(['nopol' => $nopol]);
        $vehiclesResponse = $vehicleController->getVehicles($request);
        $vehicles = json_decode($vehiclesResponse->getContent(), true);

        if (!empty($vehicles)) {
            // Ambil histori pembayaran secara detail dari semua kendaraan yang cocok
            $paymentDetailHistory = array_map(function ($vehicle) {
                return [
                    'id_transaksi' => $vehicle['id_transaksi'],
                    'tanggal_pembayaran' => $vehicle['tanggal_pembayaran'],
                    'total_pembayaran' => $vehicle['total_pembayaran'],
                    'nama' => $vehicle['nama'],
                    'nopol' => $vehicle['nopol'],
                    'status_pembayaran' => $vehicle['status_pembayaran'],
                    'kode_bayar' => $vehicle['kode_bayar'],
                    'pengiriman' => $vehicle['pengiriman'],
                    'pajak_tahunan' => $vehicle['pajak_tahunan'],
                    'biaya_admin' => $vehicle['biaya_admin'],
                    'biaya_pengiriman' => $vehicle['biaya_pengiriman']
                ];
            }, $vehicles);

            return response()->json($paymentDetailHistory);
        } else {
            return response()->json(['error' => 'No payment detail history found for the provided nopol'], 404);
        }
    }
}
