<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Log;

class HomeController extends Controller
{
    protected $client;
    protected $informationApiUrl;
    protected $samsatApiUrl;
    protected $faqApiUrl;
    protected $adminApiUrl;
    protected $userappApiUrl;

    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
        $this->informationApiUrl = config('api.information');
        $this->samsatApiUrl = config('api.samsat');
        $this->faqApiUrl = config('api.faq');
        $this->adminApiUrl = config('api.admin');
        $this->userappApiUrl = config('api.userapp');
    }

    protected function fetchDataCount($url)
    {
        try {
            $response = $this->client->get($url);
            $data = json_decode($response->getBody(), true);

            // Pastikan format respons API berupa array
            return is_array($data) ? count($data) : 0;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Menangani kesalahan dan mengembalikan 0 jika terjadi kesalahan
            
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse()->getBody()->getContents();
                
                // Log error untuk debug
                Log::error('Error fetching data from API: ' . $errorResponse);
            } else {
                Log::error('Request exception occurred: ' . $e->getMessage());
            }

            return 0;
        }
    }

    protected function fetchUserApp($url)
    {
        $email = session('email'); // Retrieve email from session
        $password = session('password'); // Retrieve password from session

        if (!$email || !$password) {
            Log::error('Email atau password tidak tersedia di sesi.');
            auth()->logout(); // Logout pengguna
            return redirect()->route('login'); // Alihkan ke halaman login
        }

        try {
            $response = $this->client->get($url, [
                'auth' => [$email, $password] // Menggunakan Basic Auth
            ]);
            $data = json_decode($response->getBody(), true);

            // Pastikan format respons API berupa array
            return is_array($data) ? count($data) : 0;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $errorResponse = $e->getResponse()->getBody()->getContents();
                Log::error('Error fetching data from API with auth: ' . $errorResponse);
            } else {
                Log::error('Request exception occurred with auth: ' . $e->getMessage());
            }

            return 0;
        }
    }

    public function dashboard()
    {
        $informationCount = $this->fetchDataCount($this->informationApiUrl);
        $samsatCount = $this->fetchDataCount($this->samsatApiUrl);
        $faqCount = $this->fetchDataCount($this->faqApiUrl);
        $adminCount = $this->fetchUserApp($this->adminApiUrl); // Menggunakan autentikasi
        $userappCount = $this->fetchUserApp($this->userappApiUrl); // Menggunakan autentikasi

        return view('admin.dashboard', compact('informationCount', 'samsatCount', 'faqCount', 'adminCount', 'userappCount'));
    }

    public function index()
    {
        $informationCount = $this->fetchDataCount($this->informationApiUrl);
        $samsatCount = $this->fetchDataCount($this->samsatApiUrl);
        $faqCount = $this->fetchDataCount($this->faqApiUrl);
        $adminCount = $this->fetchUserApp($this->adminApiUrl); // Menggunakan autentikasi
        $userappCount = $this->fetchUserApp($this->userappApiUrl); // Menggunakan autentikasi

        return view('admin.dashboard', compact('informationCount', 'samsatCount', 'faqCount', 'adminCount', 'userappCount'));
    }
}
