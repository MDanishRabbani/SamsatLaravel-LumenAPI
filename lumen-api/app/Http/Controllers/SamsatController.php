<?php

namespace App\Http\Controllers;

use App\Models\Samsat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SamsatController extends Controller
{
    public function index() {
        return Samsat::all();
    }

    public function store(Request $request) {
        // Menggunakan Validator secara manual
        $validator = Validator::make($request->all(), [
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // Mengembalikan kesalahan validasi
        }

        $samsat = Samsat::create($request->all());
        return response()->json($samsat, 201);
    }

    public function show($id) {
        return Samsat::findOrFail($id);
    }

    public function update(Request $request, $id) {
        // Menggunakan Validator secara manual
        $validator = Validator::make($request->all(), [
            'location' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // Mengembalikan kesalahan validasi
        }

        $samsat = Samsat::findOrFail($id);
        $samsat->update($request->all());
        return response()->json($samsat, 200);
    }

    public function destroy($id) {
        Samsat::destroy($id);
        return response()->json(null, 204);
    }
}
