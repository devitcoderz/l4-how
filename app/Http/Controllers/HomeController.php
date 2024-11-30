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
        $prizes = [700,375,250,150,125,100,100,75,75,50];
        $response = $this->ApiService->getData();
        $data = [];
        if($response['success']){
            $data = $response['data'];
        }

        return view("home.index",compact('data','prizes'));
    }
}
