<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.faq'); // Pastikan Anda memiliki ini di config/api.php
    }

    protected function fetchFaqs()
    {
        try {
            $response = $this->client->get($this->baseUrl);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error("Fetch FAQs failed: " . $e->getMessage());
            return null;
        }
    }

    public function adminIndexFaq()
{
    $faq = $this->fetchFaqs();

    if ($faq) {
        // Sort the FAQs by the order_column
        usort($faq, function($a, $b) {
            return $a->order_column <=> $b->order_column; // Sort ascending
        });
    }

    return view('admin.faq.faq', compact('faq'));
}


    public function create()
    {
        return view('admin.faq.create');
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

            return redirect()->route('admin.faq')->with('success', 'FAQ created successfully');
        } catch (\Exception $e) {
            Log::error("Store FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.faq')->with('error', 'Failed to create FAQ.');
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/{$id}");
            $faq = json_decode($response->getBody()->getContents());

            if (!$faq) {
                return redirect()->route('admin.faq')->with('error', 'FAQ not found.');
            }

            return view('admin.faq.edit', compact('faq'));
        } catch (\Exception $e) {
            Log::error("Edit FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.faq')->with('error', 'Failed to retrieve FAQ for editing.');
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

            return redirect()->route('admin.faq')->with('success', 'FAQ updated successfully');
        } catch (\Exception $e) {
            Log::error("Update FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.faq')->with('error', 'Failed to update FAQ.');
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
            return redirect()->route('admin.faq')->with('success', 'FAQ deleted successfully');
        } catch (\Exception $e) {
            Log::error("Delete FAQ failed: " . $e->getMessage());
            return redirect()->route('admin.faq')->with('error', 'Failed to delete FAQ.');
        }
    }

    public function reorder(Request $request)
    {
        $email = session('email');
        $password = session('password');
    
        try {
            // Validate the request input
            $request->validate([
                'order' => 'required|array',
                'order.*.id' => 'required|integer|exists:faq,id',
                'order.*.order_column' => 'required|integer'
            ]);
    
            // Send the request to the external API
            $response = $this->client->post("{$this->baseUrl}/reorder", [
                'auth' => [$email, $password],
                'json' => [
                    'order' => $request->input('order')
                ]
            ]);
    
            // Check the response status
            if ($response->getStatusCode() === 200) {
                return response()->json(['success' => true, 'message' => 'Order updated successfully']);
            }
    
            // If the API response is not 200, log it and return an error
            Log::error("API Response Error: " . $response->getBody()->getContents());
            return response()->json(['success' => false, 'message' => 'Failed to update order due to external API error'], 500);
    
        } catch (\Exception $e) {
            // Log any exceptions and return an error message
            Log::error("Reorder FAQ failed: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to update order'], 500);
        }
    }

}
