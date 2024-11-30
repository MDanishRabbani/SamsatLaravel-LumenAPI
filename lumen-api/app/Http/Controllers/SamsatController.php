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

    public function show($id) {
        return Samsat::findOrFail($id);
    }

    public function store(Request $request) {
        // Validate input
        $rules = [
            'name' => 'required|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'city' => 'required|string',
            'type' => 'required|in:statis,dinamis',
            'is_active' => 'required|boolean',
            'schedule' => 'required_if:type,dinamis|array',
            'schedule.*.day' => 'required_if:type,dinamis|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'schedule.*.address' => 'required_if:type,dinamis|string',
            'schedule.*.latitude' => 'required_if:type,dinamis|numeric',
            'schedule.*.longitude' => 'required_if:type,dinamis|numeric',
        ];

        // Only apply the schedule validation if type is 'dinamis'
        if ($request->type != 'dinamis') {
            unset($rules['schedule']);
            unset($rules['schedule.*.day']);
            unset($rules['schedule.*.address']);
            unset($rules['schedule.*.latitude']);
            unset($rules['schedule.*.longitude']);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            \Log::error('Validation failed. Request data:', $request->all());
            \Log::error('Validation errors:', $validator->errors()->toArray());
            
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'request_data' => $request->all()
            ], 422);
        }

        $samsat = Samsat::create($request->only(['name', 'address', 'latitude', 'longitude', 'city', 'type', 'is_active']));

        // Save scheduling details if present and type is 'dinamis'
        if ($request->has('schedule') && $request->type === 'dinamis') {
            $schedules = is_string($request->schedule) ? json_decode($request->schedule, true) : $request->schedule;
            
            foreach ($schedules as $item) {
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

    public function update(Request $request, $id) {
        // Find the Samsat record
        $samsat = Samsat::findOrFail($id);
    
        // Validate input
        $rules = [
            'name' => 'required|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'city' => 'required|string',
            'type' => 'required|in:statis,dinamis',
            'is_active' => 'required|boolean',
            'schedule' => 'required_if:type,dinamis|array',
            'schedule.*.day' => 'required_if:type,dinamis|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'schedule.*.address' => 'required_if:type,dinamis|string',
            'schedule.*.latitude' => 'required_if:type,dinamis|numeric',
            'schedule.*.longitude' => 'required_if:type,dinamis|numeric',
        ];
    
        // Only apply the schedule validation if type is 'dinamis'
        if ($request->type != 'dinamis') {
            unset($rules['schedule']);
            unset($rules['schedule.*.day']);
            unset($rules['schedule.*.address']);
            unset($rules['schedule.*.latitude']);
            unset($rules['schedule.*.longitude']);
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            \Log::error('Validation failed. Request data:', $request->all());
            \Log::error('Validation errors:', $validator->errors()->toArray());
            
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'request_data' => $request->all()
            ], 422);
        }
    
        // Update the Samsat record
        $samsat->update($request->only(['name', 'address', 'latitude', 'longitude', 'city', 'type', 'is_active']));
    
        // Update scheduling details if present and type is 'dinamis'
        if ($request->has('schedule') && $request->type === 'dinamis') {
            // Delete existing schedules for this Samsat (if any)
            $samsat->schedules()->delete();
    
            $schedules = is_string($request->schedule) ? json_decode($request->schedule, true) : $request->schedule;
    
            foreach ($schedules as $item) {
                $samsat->schedules()->create([
                    'day' => $item['day'],
                    'address' => $item['address'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                ]);
            }
        }
    
        return response()->json($samsat->load('schedules'), 200);
    }

    
    public function destroy($id) {
        Samsat::destroy($id);
        return response()->json(null, 204);
    }
    
}    