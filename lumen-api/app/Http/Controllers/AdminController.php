<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return Admin::all();
    }

    public function store(Request $request) {
        // Validasi permintaan
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string',
        ]);
        
        // Simpan FAQ
        $admin = Admin::create($request->all());
        return response()->json($admin, 201);
    }

    public function show($id) {
        return Admin::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|string',
        ]);
        
        $admin = Admin::findOrFail($id);
        $admin->update($request->all());
        return response()->json($admin, 200);
    }

    public function destroy($id) {
        Admin::destroy($id);
        return response()->json(null, 204);
    }
}
