<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ApiService;

class HomeController extends Controller
{
    private $ApiService;
    public function __construct(ApiService $ApiService)
    {
        $this->ApiService = $ApiService;
    }

    public function index(){
        $data['users'] = $this->ApiService->getData();
        return view("home.index");
    }
}
