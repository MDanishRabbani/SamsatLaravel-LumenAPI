<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Include User model
use Illuminate\Support\Facades\Hash; // For hashing passwords
use Illuminate\Support\Facades\Validator; // For request validation

class AdminController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.admin'); // Ensure you have this in config/api.php
    }

    /**
     * Fetch a list of admins from the API.
     *
     * @return mixed|null
     */
    protected function fetchAdmins()
    {
        try {
            $response = $this->client->get($this->baseUrl);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error("Fetch Admins failed: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Display the list of admins.
     *
     * @return \Illuminate\View\View
     */
    public function adminIndexAdmin()
    {
        $admin = $this->fetchAdmins();
        return view('admin.admin.admin', compact('admin'));
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Ensure password confirmation
        ]);

        try {
            // Create a new admin user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Hash the password for security
            ]);

            return redirect()->route('admin.admin')->with('success', 'Admin created successfully');
        } catch (\Exception $e) {
            Log::error("Store Admin failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to create Admin.');
        }
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/{$id}");
            $admin = json_decode($response->getBody()->getContents());

            if (!$admin) {
                return redirect()->route('admin.admin')->with('error', 'Admin not found.');
            }

            return view('admin.admin.edit', compact('admin'));
        } catch (\Exception $e) {
            Log::error("Edit Admin failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to retrieve Admin for editing.');
        }
    }

    /**
     * Update the specified admin in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Password is optional for update
        ]);

        try {
            // Fetch the admin to be updated
            $admin = User::findOrFail($id);
            $admin->name = $request->name;
            $admin->email = $request->email;

            // Update password if provided
            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password); // Hash new password
            }

            $admin->save(); // Save changes to the database

            return redirect()->route('admin.admin')->with('success', 'Admin updated successfully');
        } catch (\Exception $e) {
            Log::error("Update Admin failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to update Admin.');
        }
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $admin = User::findOrFail($id);
            $admin->delete(); // Delete the admin

            return redirect()->route('admin.admin')->with('success', 'Admin deleted successfully');
        } catch (\Exception $e) {
            Log::error("Delete Admin failed: " . $e->getMessage());
            return redirect()->route('admin.admin')->with('error', 'Failed to delete Admin.');
        }
    }
}
