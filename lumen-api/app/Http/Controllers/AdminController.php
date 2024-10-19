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
        $faq = Admin::create($request->all());
        return response()->json($faq, 201);
    }

    public function show($id) {
        return Admin::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|string',
        ]);
        
        $faq = Admin::findOrFail($id);
        $faq->update($request->all());
        return response()->json($faq, 200);
    }

    public function destroy($id) {
        Admin::destroy($id);
        return response()->json(null, 204);
    }
}
