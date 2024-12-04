<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Services\ApiService;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    private $ApiService;
    public function __construct(ApiService $ApiService)
    {
        $this->ApiService = $ApiService;
    }

    public function index(){
        $prizes = [700,375,250,150,125,100,100,75,75,50];

        $allUsers = [];
        $response = $this->ApiService->getData(); 
        if($response['success']){
            foreach($response['data'] as $k=>$v){
                $prize = 0 ;
                if($k < 10){
                    $prize = $prizes[$k];
                } 
                $allUsers[] = [$v['name'],$v['wager'],$prize];
            }
        }

        // //for testing without api records
        // for($i = 1 ; $i <= 10 ; $i++){
        //     $allUsers[] = ["Testing",92000,700];
        // }

        $settings = Setting::first();
        $bannerImg = !empty($settings->banner_img) && Storage::disk('public')->exists('images/' . $settings->banner_img) ? Storage::url('images/' . $settings->banner_img) :  asset('images/heading.gif');
        $backgroundImg = !empty($settings->background_img) && Storage::disk('public')->exists('images/' . $settings->background_img) ? Storage::url('images/' . $settings->background_img) : asset('images/bg-3.png');
        return view("home.index",compact('allUsers','prizes','settings','bannerImg','backgroundImg'));
    }
}
