<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SamsatController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.samsat'); // Make sure base URL is defined in config/api.php
    }

    // Fetch the list of Samsat
    protected function fetchSamsat()
    {
        try {
            $email = session('email');
            $password = session('password');

            $response = $this->client->get($this->baseUrl, [
                'auth' => [$email, $password],
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error("Fetch samsat failed: " . $e->getMessage());
            return [];
        }
    }

    public function adminIndexSamsat()
    {
        $samsat = $this->fetchSamsat();
        return view('admin.samsat.samsat', compact('samsat'));
    }

    public function create()
    {
        return view('admin.samsat.create'); // Adjust with the correct view location
    }

    // Store the new Samsat data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:statis,dinamis', // Add type validation
            'is_active' => 'required|boolean', // Add active status validation
            'schedule' => 'nullable|array', // Optional
            'schedule.*.day' => 'required_with:schedule|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'schedule.*.address' => 'required_with:schedule|string',
            'schedule.*.latitude' => 'required_with:schedule|numeric',
            'schedule.*.longitude' => 'required_with:schedule|numeric',
        ]);

        $email = session('email');
        $password = session('password');

        // Get the request data
        $data = $request->only(['name', 'address', 'city', 'latitude', 'longitude', 'type', 'is_active']);

        // Only include schedule if type is 'dinamis'
        if ($request->type === 'dinamis') {
            $data['schedule'] = $request->schedule;
        }

        try {
            $response = $this->client->post($this->baseUrl, [
                'auth' => [$email, $password],
                'json' => $data,
            ]);

            if ($response->getStatusCode() === 201) {
                return redirect()->route('admin.samsat')->with('success', 'Samsat created successfully');
            } else {
                return redirect()->route('admin.samsat')->with('error', 'Failed to create Samsat. API responded with status: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            Log::error("Create Samsat failed: " . $e->getMessage());
            return redirect()->route('admin.samsat')->with('error', 'An error occurred while creating Samsat.');
        }
    }

    // Update Samsat data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:statis,dinamis',
            'is_active' => 'required|boolean',
            'schedule' => 'nullable|array',
            'schedule.*.day' => 'required_with:schedule|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'schedule.*.address' => 'required_with:schedule|string',
            'schedule.*.latitude' => 'required_with:schedule|numeric',
            'schedule.*.longitude' => 'required_with:schedule|numeric',
        ]);

        // Get the request data
        $data = $request->only(['name', 'address', 'city', 'latitude', 'longitude', 'type', 'is_active']);

        // Only include schedule if type is 'dinamis'
        if ($request->type === 'dinamis') {
            $data['schedule'] = $request->schedule;
        }

        $email = session('email');
        $password = session('password');

        try {
            $response = $this->client->put("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password],
                'json' => $data,
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('admin.samsat')->with('success', 'Samsat updated successfully');
            } else {
                return redirect()->route('admin.samsat')->with('error', 'Failed to update Samsat. API responded with status: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            Log::error("Update Samsat failed: " . $e->getMessage());
            return redirect()->route('admin.samsat')->with('error', 'An error occurred while updating Samsat.');
        }
    }

    // Delete Samsat data
    public function destroy($id)
    {
        $email = session('email');
        $password = session('password');

        try {
            $response = $this->client->delete("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password],
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('admin.samsat')->with('success', 'Samsat deleted successfully');
            } else {
                return redirect()->route('admin.samsat')->with('error', 'Failed to delete Samsat. API responded with status: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            Log::error("Delete Samsat failed: " . $e->getMessage());
            return redirect()->route('admin.samsat')->with('error', 'An error occurred while deleting Samsat.');
        }
    }
}
