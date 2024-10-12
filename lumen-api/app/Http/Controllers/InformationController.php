<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Information;

class InformationController extends Controller
{
    // Mendapatkan semua informasi
    public function index() {
        return Information::all();
    }

    // Menyimpan informasi baru
    public function store(Request $request) {
        // Validasi data menggunakan Validator
        $validator = Validator::make($request->all(), [
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Memastikan ukuran maksimal 2MB
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Simpan file gambar
        $imagePath = $request->file('image_url')->store('images', 'public'); // Simpan gambar ke folder public/images

        // Simpan rekaman informasi baru dengan path gambar
        $information = Information::create([
            'image_url' => $imagePath, // Simpan path gambar
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);

        return response()->json($information, 201);
    }

    // Mendapatkan informasi berdasarkan ID
    public function show($id) {
        $information = Information::findOrFail($id);
        return response()->json($information);
    }

    // Memperbarui informasi berdasarkan ID
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'image_url' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:2048', // Memastikan ukuran maksimal 2MB
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $information = Information::findOrFail($id);

        // Cek apakah ada gambar yang diupload
        if ($request->hasFile('image_url')) {
            // Simpan file gambar
            $imagePath = $request->file('image_url')->store('images', 'public'); // Simpan gambar ke folder public/images
            $information->image_url = $imagePath; // Update path gambar
        }

        // Memperbarui informasi
        $information->title = $request->input('title', $information->title);
        $information->description = $request->input('description', $information->description);
        $information->date = $request->input('date', $information->date);
        $information->save(); // Simpan perubahan

        return response()->json($information, 200);
    }

    // Menghapus informasi berdasarkan ID
    public function destroy($id) {
        Information::destroy($id);
        return response()->json(null, 204);
    }
}
