<?php

namespace App\Http\Controllers;

use App\Models\Samsat;
use Illuminate\Http\Request;
use GuzzleHttp\Client; // Make sure to include GuzzleHttp\Client

class SamsatController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.samsat'); // Assuming you have defined this in your config/api.php file
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
            'name' => 'required', // Validate name field
            'location' => 'required', // Validate location field
        ]);

        // Include the name in the API request
        $this->client->post("{$this->baseUrl}", [
            'json' => [
                'name' => $request->name, // Include name
                'location' => $request->location // Include location
            ]
        ]);

        return redirect()->route('admin.samsat');
    }

    public function edit($id)
    {
        $samsat = json_decode(file_get_contents("{$this->baseUrl}/{$id}"));
        return view('admin.samsat.edit', compact('samsat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', // Validate name field
            'location' => 'required', // Validate location field
        ]);

        // Include the name in the API request
        $this->client->put("{$this->baseUrl}/{$id}", [
            'json' => [
                'name' => $request->name, // Include name
                'location' => $request->location // Include location
            ]
        ]);

        return redirect()->route('admin.samsat')->with('success', 'Location updated successfully');
    }

    public function destroy($id)
    {
        $this->client->delete("{$this->baseUrl}/{$id}");
        return redirect()->route('admin.samsat');
    }
}
