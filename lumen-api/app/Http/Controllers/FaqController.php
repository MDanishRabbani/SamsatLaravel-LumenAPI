<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index() {
        return Faq::all();
    }

    public function store(Request $request) {
        // Validasi permintaan
        $this->validate($request, [
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);
        
        // Simpan FAQ
        $faq = Faq::create($request->all());
        return response()->json($faq, 201);
    }

    public function show($id) {
        return Faq::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'question' => 'sometimes|required|string',
            'answer' => 'sometimes|required|string',
        ]);
        
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
        return response()->json($faq, 200);
    }

    public function destroy($id) {
        Faq::destroy($id);
        return response()->json(null, 204);
    }

    public function reorder(Request $request)
{
    $this->validate($request, [
        'order' => 'required|array',
        'order.*.id' => 'required|integer|exists:faq,id',
        'order.*.order_column' => 'required|integer'
    ]);

    foreach ($request->order as $item) {
        Faq::where('id', $item['id'])->update(['order_column' => $item['order_column']]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Order updated successfully'
    ]);
}


}   
