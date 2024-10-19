<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.admin'); // Pastikan Anda memiliki ini di config/api.php
    }

    protected function fetchAdmins()
    {
        try {
            $response = $this->client->get($this->baseUrl);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error("Fetch FAQs failed: " . $e->getMessage());
            return null;
        }
    }

    public function adminIndexAdmin()
    {
        $admin = $this->fetchAdmins();
        return view('admin.admin.admin', compact('admin'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $email = session('email'); // Mendapatkan email dari session
        $password = session('password'); // Mendapatkan password dari session

        try {
            $this->client->post($this->baseUrl, [
                'auth' => [$email, $password], // Menggunakan email dan password dari session untuk Basic Auth
                'json' => [
                    'question' => $request->question,
                    'answer' => $request->answer
                ]
            ]);

            return redirect()->route('admin.admin')->with('success', 'FAQ created successfully');
        } catch (\Exception $e) {
            Log::error("Store FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to create FAQ.');
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/{$id}");
            $admin = json_decode($response->getBody()->getContents());

            if (!$admin) {
                return redirect()->route('admin.admin')->with('error', 'FAQ not found.');
            }

            return view('admin.admin.edit', compact('admin'));
        } catch (\Exception $e) {
            Log::error("Edit FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to retrieve FAQ for editing.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $email = session('email'); // Mendapatkan email dari session
        $password = session('password'); // Mendapatkan password dari session

        try {
            $this->client->put("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password], // Menggunakan email dan password dari session untuk Basic Auth
                'json' => [
                    'question' => $request->question,
                    'answer' => $request->answer
                ]
            ]);

            return redirect()->route('admin.admin')->with('success', 'FAQ updated successfully');
        } catch (\Exception $e) {
            Log::error("Update FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to update FAQ.');
        }
    }

    public function destroy($id)
    {
        $email = session('email'); // Mendapatkan email dari session
        $password = session('password'); // Mendapatkan password dari session

        try {
            $this->client->delete("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password] // Menggunakan email dan password dari session untuk Basic Auth
            ]);
            return redirect()->route('admin.admin')->with('success', 'FAQ deleted successfully');
        } catch (\Exception $e) {
            Log::error("Delete FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to delete FAQ.');
        }
    }
}
