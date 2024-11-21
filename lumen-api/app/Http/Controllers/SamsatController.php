<?php

namespace App\Http\Controllers;

use App\Models\Samsat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SamsatController extends Controller
{
    public function index() {
        return Samsat::with('schedules')->get(); // Pastikan untuk memuat relasi schedules
    }

    public function store(Request $request) {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'nullable|string', // For dynamic Samsat, address can be determined based on scheduling
            'latitude' => 'nullable|numeric', // Nullable because it may be dynamically determined
            'longitude' => 'nullable|numeric',
            'city' => 'required|string',
            'type' => 'required|in:statis,dinamis', // Add type field to distinguish between types
            'is_active' => 'required|boolean', // Add field for active status
            'schedule' => 'nullable|array', // Optional, for dynamic Samsat with scheduling
            'schedule.*.day' => 'required_with:schedule|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', // Day validation
            'schedule.*.address' => 'required_with:schedule|string', // Address for scheduled days
            'schedule.*.latitude' => 'required_with:schedule|numeric',
            'schedule.*.longitude' => 'required_with:schedule|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $samsat = Samsat::create($request->only(['name', 'address', 'latitude', 'longitude', 'city', 'type', 'is_active']));
    
        // Save scheduling details if present
        if ($request->has('schedule')) {
            foreach ($request->schedule as $item) {
                $samsat->schedules()->create([
                    'day' => $item['day'],
                    'address' => $item['address'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                ]);
            }
        }
    
        return response()->json($samsat->load('schedules'), 201);
    }
}    