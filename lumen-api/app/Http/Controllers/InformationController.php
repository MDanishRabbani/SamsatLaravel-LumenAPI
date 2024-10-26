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
        // Validasi data
        $validator = Validator::make($request->all(), [
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif', // Maksimal 2MB
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
   

    // public function update(Request $request, $id) {
    //     // Validasi data
    //     $validator = Validator::make($request->all(), [
    //         'image_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
    //         'title' => 'sometimes|required|string',
    //         'description' => 'sometimes|required|string',
    //         'date' => 'sometimes|required|date',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
    
    //     // Temukan informasi berdasarkan ID
    //     $information = Information::findOrFail($id);
    
    //     // Cek apakah ada gambar baru yang diupload
    //     if ($request->hasFile('image_url')) {
    //         // Hapus gambar lama jika ada
    //         if ($information->image_url) {
    //             if (\Storage::disk('public')->exists($information->image_url)) {
    //                 \Storage::disk('public')->delete($information->image_url);
    //             }
    //         }
    
    //         // Simpan file gambar baru
    //         $imagePath = $request->file('image_url')->store('images', 'public');
    //         $information->image_url = $imagePath; // Update path gambar baru
    //     }
    
    //     // Memperbarui informasi lainnya
    //     $information->title = $request->input('title', $information->title);
    //     $information->description = $request->input('description', $information->description);
    //     $information->date = $request->input('date', $information->date);
    
    //     $information->save(); // Simpan perubahan
    
    //     return response()->json($information, 200);
    // }

//     public function update(Request $request, $id)
// {
//     // Validasi data
//     $validator = Validator::make($request->all(), [
//         'image_url' => 'required|image|mimes:jpeg,png,jpg,gif',
//         'title' => 'sometimes|required|string',
//         'description' => 'sometimes|required|string',
//         'date' => 'sometimes|required|date',
//     ]);

//     if ($validator->fails()) {
//         return response()->json($validator->errors(), 422);
//     }

//     // Temukan data yang akan diubah
//     $information = Information::findOrFail($id);

//     // Update image URL directly
//     $information->image_url = $request->input('image_url');

//     // Update data lainnya
//     $information->title = $request->input('title');
//     $information->description = $request->input('description');
//     $information->date = $request->input('date');

//     // Simpan perubahan
//     $information->save();

//     return response()->json($information, 200);
// }

// public function update(Request $request, $id) {
//     // Validasi data
//     $validator = Validator::make($request->all(), [
//         'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
//         'title' => 'sometimes|required|string',
//         'description' => 'sometimes|required|string',
//         'date' => 'sometimes|required|date',
//     ]);

//     if ($validator->fails()) {
//         return response()->json($validator->errors(), 422);
//     }

//     // Temukan rekaman berdasarkan ID
//     $information = Information::find($id);
//     if (!$information) {
//         return response()->json(['message' => 'Information not found'], 404);
//     }

//     // Simpan file gambar jika ada file baru yang diunggah
//     if ($request->hasFile('image_url')) {
//         $imagePath = $request->file('image_url')->store('images', 'public');
//         $information->image_url = $imagePath;
//     }

//     // Perbarui informasi
//     $information->title = $request->input('title');
//     $information->description = $request->input('description');
//     $information->date = $request->input('date');
//     $information->save();

//     return response()->json($information, 200);
// }

public function update(Request $request, $id) {
    // Validasi data
    $validator = Validator::make($request->all(), [
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Maksimal 2MB
        'title' => 'required|string',
        'description' => 'required|string',
        'date' => 'required|date',
    ]);

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
        $information->image_url = $imagePath;
    }

    // Perbarui informasi lainnya
    $information->title = $request->input('title', $information->title);
    $information->description = $request->input('description', $information->description);
    $information->date = $request->input('date', $information->date);

    // Simpan perubahan
    $information->save();

    return response()->json($information, 200);
}




    // Menghapus informasi berdasarkan ID
    public function destroy($id) {
        Information::destroy($id);
        return response()->json(null, 204);
    }
}
