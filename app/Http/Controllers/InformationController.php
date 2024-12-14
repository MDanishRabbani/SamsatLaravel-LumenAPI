<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class InformationController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.information'); // Pastikan ini didefinisikan di config/api.php
    }

    // Fungsi untuk mengambil data informasi dari API
    protected function fetchInformation()
    {
        try {
            $response = $this->client->get($this->baseUrl);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error("Fetch information failed: " . $e->getMessage());
            return [];
        }
    }

    // Menampilkan halaman index informasi admin
    public function adminIndexInformation()
    {
        $information = $this->fetchInformation();
        return view('admin.information.information', compact('information'));
    }

    // Menampilkan halaman form untuk membuat informasi baru
    public function create()
    {
        return view('admin.information.create');
    }

    // Menyimpan informasi baru
    public function store(Request $request)
    {
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif',
            'title' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        $email = session('email');
        $password = session('password');

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ];

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url');
            $formParams = [
                [
                    'name' => 'image_url',
                    'contents' => fopen($imagePath->getPathname(), 'r'),
                    'filename' => $imagePath->getClientOriginalName(),
                ],
                [
                    'name' => 'title',
                    'contents' => $data['title'],
                ],
                [
                    'name' => 'description',
                    'contents' => $data['description'],
                ],
                [
                    'name' => 'date',
                    'contents' => $data['date'],
                ],
            ];
        }

        try {
            $response = $this->client->post($this->baseUrl, [
                'auth' => [$email, $password],
                'multipart' => $formParams,
            ]);

            if ($response->getStatusCode() === 201) {
                return redirect()->route('admin.information')->with('success', 'Information created successfully');
            } else {
                return redirect()->route('admin.information')->with('error', 'Failed to create information. API responded with status: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            Log::error("Store information failed: " . $e->getMessage());
            return redirect()->route('admin.information')->with('error', 'An error occurred while creating information.');
        }
    }

    // Menampilkan halaman edit untuk informasi tertentu
    public function edit($id)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/{$id}");
            $information = json_decode($response->getBody()->getContents());

            if (!$information) {
                return redirect()->route('admin.information')->with('error', 'Information not found.');
            }

            return view('admin.information.edit', compact('information'));
        } catch (\Exception $e) {
            Log::error("Edit information failed: " . $e->getMessage());
            return redirect()->route('admin.information')->with('error', 'Failed to retrieve information for editing.');
        }
    }


public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'date' => 'required',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Adjust max size as needed
    ]);

    // Get email and password from the session
    $email = session('email');
    $password = session('password');

    if (!$email || !$password) {
        Log::error('Email atau password tidak tersedia di sesi.');
        auth()->logout(); // Logout pengguna
        return redirect()->route('login'); // Alihkan ke halaman login
    }
    // Prepare the data to send
    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'date' => $request->date,
    ];

    // Check if an image has been uploaded
    if ($request->hasFile('image_url')) {
        // Handle image upload
        $image = $request->file('image_url');
        $imagePath = $image->store('images', 'public'); // Store in 'public/images'
        
        $data['image_url'] = $imagePath; // Add the image path to the data
    }

    // Make a PUT request to the API using Basic Auth
    $this->client->put("{$this->baseUrl}/{$id}", [
        'auth' => [$email, $password],
        'json' => $data
    ]);

    return redirect()->route('admin.information')->with('success', 'Information updated successfully');
}


    // Menghapus informasi tertentu
    public function destroy($id)
    {
        $email = session('email');
        $password = session('password');

        if (!$email || !$password) {
            Log::error('Email atau password tidak tersedia di sesi.');
            auth()->logout(); // Logout pengguna
            return redirect()->route('login'); // Alihkan ke halaman login
        }

        try {
            $this->client->delete("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password]
            ]);

            return redirect()->route('admin.information')->with('success', 'Information deleted successfully');
        } catch (\Exception $e) {
            Log::error("Delete information failed: " . $e->getMessage());
            return redirect()->route('admin.information')->with('error', 'An error occurred while deleting information.');
        }
    }
}
