<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information; // Import model Anda di sini

class InformationController extends Controller
{
    // Mendapatkan semua informasi
    public function index() {
        return Information::all();
    }

    // Menyimpan informasi baru
    public function store(Request $request) {
        $request->validate([
            'image_url' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        // Simpan rekaman informasi baru
        $information = Information::create($request->all());
        return response()->json($information, 201);
    }

    // Mendapatkan informasi berdasarkan ID
    public function show($id) {
        $information = Information::findOrFail($id);
        return response()->json($information);
    }

    // Memperbarui informasi berdasarkan ID
    public function update(Request $request, $id) {
        $request->validate([
            'image_url' => 'sometimes|required|string',
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
        ]);

        $information = Information::findOrFail($id);
        $information->update($request->all());
        return response()->json($information, 200);
    }

    // Menghapus informasi berdasarkan ID
    public function destroy($id) {
        Information::destroy($id);
        return response()->json(null, 204);
    }
}
