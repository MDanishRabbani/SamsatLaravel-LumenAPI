<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Endpoint to retrieve payment details based on vehicle information
    public function getPaymentDetails(Request $request)
    {
        $paymentDetails = [
            'no_bayar' => 'PAY123456',
            'rincian_biaya_pajak' => [
                'biaya_pajak' => 500000,
                'denda' => 50000
            ],
            'total' => 550000
        ];

        return response()->json($paymentDetails);
    }

    // Endpoint to retrieve payment history based on NIK
    public function getPaymentHistory(Request $request)
    {
        $nik = $request->input('nik');

        $paymentHistory = [
            [
                'id' => 1,
                'nik' => $nik,
                'nama_pemilik' => 'John Doe',
                'masa_aktif' => '2023-2024',
                'status' => 'Sudah Bayar',
                'nopol' => 'BL123A'
            ],
            [
                'id' => 2,
                'nik' => $nik,
                'nama_pemilik' => 'John Doe',
                'masa_aktif' => '2022-2023',
                'status' => 'Sudah Bayar',
                'nopol' => 'BL456B'
            ]
        ];

        return response()->json($paymentHistory);
    }
}
