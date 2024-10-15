<?php

namespace App\Http\Controllers;

use App\Models\Samsat;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class SamsatController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.samsat'); // Make sure to define this base URL in the config/api.php file
    }

    protected function fetchSamsatsamsat()
    {
        return json_decode(file_get_contents("{$this->baseUrl}"));
    }

    public function adminIndexsamsat()
    {
        $samsat = $this->fetchSamsatsamsat();
        return view('admin.samsat.samsat', compact('samsat'));
    }

    public function create()
    {
        return view('admin.samsat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required',
        ]);

        // Get email and password from the session
        $email = session('email');
        $password = session('password');

        // Make a POST request to the API using Basic Auth
        $this->client->post("{$this->baseUrl}", [
            'auth' => [$email, $password],
            'json' => [
                'name' => $request->name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'city' => $request->city
            ]
        ]);

        return redirect()->route('admin.samsat')->with('success', 'Samsat created successfully');
    }

    public function edit($id)
    {
        $samsat = json_decode(file_get_contents("{$this->baseUrl}/{$id}"));
        return view('admin.samsat.edit', compact('samsat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required',
        ]);

        // Get email and password from the session
        $email = session('email');
        $password = session('password');

        // Make a PUT request to the API using Basic Auth
        $this->client->put("{$this->baseUrl}/{$id}", [
            'auth' => [$email, $password],
            'json' => [
                'name' => $request->name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'city' => $request->city
            ]
        ]);

        return redirect()->route('admin.samsat')->with('success', 'Samsat updated successfully');
    }

    public function destroy($id)
    {
        // Get email and password from the session
        $email = session('email');
        $password = session('password');

        // Make a DELETE request to the API using Basic Auth
        $this->client->delete("{$this->baseUrl}/{$id}", [
            'auth' => [$email, $password]
        ]);

        return redirect()->route('admin.samsat')->with('success', 'Samsat deleted successfully');
    }
}
