<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FaqController extends Controller
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('api.faq'); // Ensure you have this set in your config/api.php
    }

    protected function fetchFaqs()
    {
        $response = $this->client->get($this->baseUrl);
        return json_decode($response->getBody());
    }

    public function adminIndexFaq()
    {
        $faq = $this->fetchFaqs();
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

        $this->client->post($this->baseUrl, [
            'json' => [
                'question' => $request->question,
                'answer' => $request->answer
            ]
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ created successfully');
    }

    public function edit($id)
    {
        $response = $this->client->get("{$this->baseUrl}/{$id}");
        $faq = json_decode($response->getBody());
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $this->client->put("{$this->baseUrl}/{$id}", [
            'json' => [
                'question' => $request->question,
                'answer' => $request->answer
            ]
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ updated successfully');
    }

    public function destroy($id)
    {
        $this->client->delete("{$this->baseUrl}/{$id}");
        return redirect()->route('admin.faq')->with('success', 'FAQ deleted successfully');
    }
}
