<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Mengimpor rute dari Lumen
require __DIR__.'/../lumen-api/routes/web.php'; // Pastikan jalur ini benar

/*
|--------------------------------------------------------------------------
// Rute default API
|--------------------------------------------------------------------------
// Anda dapat menambahkan rute API lainnya di sini jika diperlukan.
*/

// Contoh rute pengguna (hanya jika Anda memerlukan autentikasi)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
