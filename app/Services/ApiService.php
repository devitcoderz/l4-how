<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ApiService
{
    public function getData(){
        $response = Http::withHeaders([
            'Origin' => 'https://bc.game/',
            'Content-Type' => 'application/json',
        ])
        ->timeout(30) // Set a reasonable timeout in case of issues
        ->post('https://bc.game/api/agent/open-api/kol/invitees/', [
            'invitationCode' => 'sncbc',
            'accessKey' => 'wdDF9rcs17w9JPS6',
        ]);

        // Check the response status or handle errors
        if ($response->successful()) {
            // Successful response
            dd($response->json());
        } else {
            // Handle failed response
            dd($response->status());
        }

    }


    
}
