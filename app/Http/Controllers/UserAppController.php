<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Include User model
use Illuminate\Support\Facades\Hash; // For hashing passwords
use Illuminate\Support\Facades\Validator; // For request validation

class UserAppController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.userapp'); // Ensure you have this in config/api.php
    }

    /**
     * Fetch a list of users from the API.
     *
     * @return mixed|null
     */
    protected function fetchUserApp()
    {
        try {
            $response = $this->client->get($this->baseUrl);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error("Fetch UserApp failed: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Display the list of users.
     *
     * @return \Illuminate\View\View
     */
    public function adminIndexUserApp()
    {
        $userapp = $this->fetchUserApp();
        return view('admin.userapp.userapp', compact('userapp'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.userapp.create');
    }

    public function store(Request $request)
    {
        $email = session('email'); // Retrieve email from session
        $password = session('password'); // Retrieve password from session
    
        // Validate incoming request data
        $request->validate([
            'nik' => 'sometimes|required|string',
            'nama' => 'sometimes|required|string',
            'tempat_lahir' => 'sometimes|required|string',
            'tanggal_lahir' => 'sometimes|required|date',
            'jenis_kelamin' => 'sometimes|required|in:Pria,Wanita',
            'alamat_ktp' => 'sometimes|required|string',
            'nomor_hp' => 'sometimes|required|numeric|digits_between:10,15',
            'email' => 'sometimes|required|email',
            'pin' => 'sometimes|required|numeric|digits:6',
        ]);
    
        try {
            // Create a new user via API using Basic Auth with session email and password
            $this->client->post($this->baseUrl, [
                'auth' => [$email, $password], // Using Basic Auth
                'json' => [
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat_ktp' => $request->alamat_ktp,
                    'nomor_hp' => $request->nomor_hp,
                    'email' => $request->email,
                    'pin' => $request->pin
                ]
            ]);
    
            return redirect()->route('admin.userapp')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            Log::error("Store UserApp failed: " . $e->getMessage());
            return redirect()->route('admin.userapp')->with('error', 'Failed to create User.');
        }
    }
    
    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $email = session('email'); // Retrieve email from session
        $password = session('password'); // Retrieve password from session
    
        try {
            // Get the user data via API using Basic Auth with session email and password
            $response = $this->client->get("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password] // Using Basic Auth
            ]);
            $userapp = json_decode($response->getBody()->getContents());
    
            if (!$userapp) {
                return redirect()->route('admin.userapp')->with('error', 'User not found.');
            }
    
            return view('admin.userapp.edit', compact('userapp'));
        } catch (\Exception $e) {
            Log::error("Edit UserApp failed: " . $e->getMessage());
            return redirect()->route('admin.userapp')->with('error', 'Failed to retrieve User for editing.');
        }
    }
    
    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $email = session('email'); // Retrieve email from session
        $password = session('password'); // Retrieve password from session
    
        // Validate incoming request data
        $request->validate([
            'nik' => 'sometimes|required|string',
            'nama' => 'sometimes|required|string',
            'tempat_lahir' => 'sometimes|required|string',
            'tanggal_lahir' => 'sometimes|required|date',
            'jenis_kelamin' => 'sometimes|required|in:Pria,Wanita',
            'alamat_ktp' => 'sometimes|required|string',
            'nomor_hp' => 'sometimes|required|numeric|digits_between:10,15',
            'pin' => 'sometimes|required|numeric|digits:6',
        ]);
    
        try {
            // Update the user via API using Basic Auth with session email and password
            $this->client->put("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password], // Using Basic Auth
                'json' => [
                    'nik' => $request->nik,
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat_ktp' => $request->alamat_ktp,
                    'nomor_hp' => $request->nomor_hp,
                    'pin' => $request->pin
                ]
            ]);
    
            return redirect()->route('admin.userapp')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            Log::error("Update UserApp failed: " . $e->getMessage());
            return redirect()->route('admin.userapp')->with('error', 'Failed to update User.');
        }
    }
    

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $email = session('email'); // Retrieve email from session
        $password = session('password'); // Retrieve password from session

        try {
            // Delete the user via the API using Basic Auth with session email and password
            $this->client->delete("{$this->baseUrl}/{$id}", [
                'auth' => [$email, $password] // Using Basic Auth
            ]);
            return redirect()->route('admin.userapp')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            Log::error("Delete UserApp failed: " . $e->getMessage());
            return redirect()->route('admin.userapp')->with('error', 'Failed to delete User.');
        }
    }
}
