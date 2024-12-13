<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // Tambahkan use Storage
use App\Models\Information;

class InformationController extends Controller
{
    // Mendapatkan semua informasi
    public function index() {
        return Information::all();
    }

    // Menyimpan informasi baru
    public function store(Request $request) {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Simpan file gambar
        $imagePath = $request->file('image_url')->store('images', 'public');

        // Simpan rekaman informasi baru
        $information = Information::create([
            'image_url' => $imagePath,
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
        // Validasi data
        $validator = Validator::make($request->all(), [
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
        ]);
    
        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation error',
                'details' => $validator->errors()
            ], 422);
        }
    
        // Temukan data informasi berdasarkan ID
        $information = Information::findOrFail($id);
    
        // Cek apakah ada gambar baru yang diunggah
        if ($request->hasFile('image_url')) {
            // Hapus gambar lama jika ada
            if ($information->image_url && \Storage::disk('public')->exists($information->image_url)) {
                \Storage::disk('public')->delete($information->image_url);
            }
    
            // Simpan file gambar baru
            $imagePath = $request->file('image_url')->store('images', 'public');
            $information->image_url = $imagePath; // Perbarui URL gambar di database
        }
    
        // Perbarui informasi lainnya
        $information->title = $request->input('title', $information->title);
        $information->description = $request->input('description', $information->description);
        $information->date = $request->input('date', $information->date);
    
        // Simpan perubahan ke database
        $information->save();
    
        return response()->json($information, 200);
    }
    

    // Menghapus informasi berdasarkan ID
    public function destroy($id) {
        $information = Information::findOrFail($id);

        // Hapus gambar dari storage
        if ($information->image_url && Storage::disk('public')->exists($information->image_url)) {
            Storage::disk('public')->delete($information->image_url);
        }

        $information->delete();
        
        return response()->json(null, 204);
    }
}
