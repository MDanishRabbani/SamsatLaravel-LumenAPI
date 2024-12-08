<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    protected $client;
    protected $informationApiUrl;
    protected $samsatApiUrl;
    protected $faqApiUrl;
    protected $adminApiUrl;

    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
        $this->informationApiUrl = config('api.information'); // Sesuaikan URL ini di config/api.php
        $this->samsatApiUrl = config('api.samsat'); // Sesuaikan URL ini di config/api.php
        $this->faqApiUrl = config('api.faq');
        $this->adminApiUrl = config('api.admin');
        $this->userappApiUrl = config('api.userapp');
    }

    protected function fetchDataCount($url)
    {
        $response = $this->client->get($url);
        $data = json_decode($response->getBody(), true);

        // Pastikan format respons API berupa array
        return is_array($data) ? count($data) : 0;
    }

    public function dashboard()
    {
        $informationCount = $this->fetchDataCount($this->informationApiUrl);
        $samsatCount = $this->fetchDataCount($this->samsatApiUrl);
        $faqCount = $this->fetchDataCount($this->faqApiUrl);
        $adminCount = $this->fetchDataCount($this->adminApiUrl);
        $userapp = $this->fetchDataCount($this->userappApiUrl);

        return view('admin.dashboard', compact('informationCount', 'samsatCount', 'faqCount', 'adminCount', 'userapp'));
    }

    public function index()
    {
        $informationCount = $this->fetchDataCount($this->informationApiUrl);
        $samsatCount = $this->fetchDataCount($this->samsatApiUrl);
        $faqCount = $this->fetchDataCount($this->faqApiUrl);
        $adminCount = $this->fetchDataCount($this->adminApiUrl);
        $userappCount = $this->fetchDataCount($this->userappApiUrl);

        return view('admin.dashboard', compact('informationCount', 'samsatCount', 'faqCount', 'adminCount', 'userappCount'));
    }
}
