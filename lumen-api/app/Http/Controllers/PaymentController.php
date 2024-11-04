<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Endpoint to retrieve payment details based on vehicle information
     public function getPaymentDetails(Request $request)
    {
        $nopol = $request->input('nopol');
        
        // Sample data for different vehicles
        $paymentDetailsData = [
            'BL0909BNA' => [
                'no_bayar' => 'PAY123456',
                'rincian_biaya_pajak' => [
                    'biaya_pajak' => 500000,
                    'denda' => 50000
                ],
                'total' => 550000
            ],
            'BL8560IDN' => [
                'no_bayar' => 'PAY654321',
                'rincian_biaya_pajak' => [
                    'biaya_pajak' => 600000,
                    'denda' => 75000
                ],
                'total' => 675000
            ]
        ];

        // Fetch payment details for the given nopol, or return an empty response if not found
        $paymentDetails = $paymentDetailsData[$nopol] ?? null;

        if ($paymentDetails) {
            return response()->json($paymentDetails);
        } else {
            return response()->json(['error' => 'No payment details found for the provided nopol'], 404);
        }
    }


    // Endpoint to retrieve payment history based on NIK
    public function getPaymentHistory(Request $request)
    {
        $nik = $request->input('nik');

        $paymentHistory = [
            [
                'id' => 1,
                'nik' => $nik,
                'nopol' => 'BL0909BNA',
                'status' => 'Sudah Bayar'
                
            ],
            [
                'id' => 2,
                'nik' => $nik,
                'nopol' => 'BL8560IDN',
                'status' => 'Sudah Bayar'
                
            ]
        ];

        return response()->json($paymentHistory);
    }
}
