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

        $allUsers = '';
        $response = $this->ApiService->getData(); 
        if($response['success']){
            foreach($response['data'] as $k=>$v){
                $prize = 0 ;
                if($k < 10){
                    $prize = $prizes[$k];
                } 
                $allUsers .= '["'.$v['name'].'",'.$v['wager'].','.$prize.'],';
            }

            $allUsers = rtrim($allUsers,",");
        }

        $allUsers = '['.$allUsers.']';

        return view("home.index",compact('allUsers','prizes'));
    }
}
