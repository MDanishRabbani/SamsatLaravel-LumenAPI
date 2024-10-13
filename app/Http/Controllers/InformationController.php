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
        $this->baseUrl = config('api.information');
    }

    protected function fetchInformation()
    {
        try {
            $response = $this->client->get($this->baseUrl);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error("Fetch information failed: " . $e->getMessage());
            return null;
        }
    }

    public function adminIndexInformation()
    {
        $information = $this->fetchInformation();
        return view('admin.information.information', compact('information'));
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'information' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date'
        ]);

        $data = [
            'information' => $request->information,
            'description' => $request->description,
            'date' => $request->date,
        ];

        $image = $request->file('image_url');

        try {
            $response = $this->client->post($this->baseUrl, [
                'multipart' => [
                    [
                        'name' => 'image_url',
                        'contents' => fopen($image->getRealPath(), 'r'),
                        'filename' => $image->getClientOriginalName()
                    ],
                    [
                        'name' => 'information',
                        'contents' => $data['information']
                    ],
                    [
                        'name' => 'description',
                        'contents' => $data['description']
                    ],
                    [
                        'name' => 'date',
                        'contents' => $data['date']
                    ],
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return redirect()->route('admin.information')->with('success', 'Information created successfully');
            } else {
                return redirect()->route('admin.information')->with('error', 'Failed to create information.');
            }
        } catch (\Exception $e) {
            Log::error("Store information failed: " . $e->getMessage());
            return redirect()->route('admin.information')->with('error', 'An error occurred while creating information.');
        }
    }

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
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date'
        ]);

        $data = [
            [
                'name' => 'title',
                'contents' => $request->title
            ],
            [
                'name' => 'description',
                'contents' => $request->description
            ],
            [
                'name' => 'date',
                'contents' => $request->date
            ],
        ];

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $data[] = [
                'name' => 'image_url',
                'contents' => fopen($image->getRealPath(), 'r'),
                'filename' => $image->getClientOriginalName()
            ];
        }

        try {
            $this->client->put("{$this->baseUrl}/{$id}", [
                'multipart' => $data
            ]);

            return redirect()->route('admin.information')->with('success', 'Information updated successfully');
        } catch (\Exception $e) {
            Log::error("Update information failed: " . $e->getMessage());
            return redirect()->route('admin.information')->with('error', 'Failed to update information.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->client->delete("{$this->baseUrl}/{$id}");
            return redirect()->route('admin.information')->with('success', 'Information deleted successfully');
        } catch (\Exception $e) {
            Log::error("Delete information failed: " . $e->getMessage());
            return redirect()->route('admin.information')->with('error', 'Failed to delete information.');
        }
    }
}
