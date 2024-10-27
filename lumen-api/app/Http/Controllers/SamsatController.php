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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $samsat = Samsat::create($request->all());
        return response()->json($samsat, 201);
    }

    public function show($id) {
        return Samsat::findOrFail($id);
    }

    public function update(Request $request, $id) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
            'city' => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
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
