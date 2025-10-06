<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PisApiRepository
{
    private $apiToken;
    private $apiUrl;
    
    public function __construct()
    {
        $this->apiToken = env('PIS_API_TOKEN');
        $this->apiUrl   = env('PIS_API_ROOT_URL');
    }
    public function getProjectInformation(){
       
        $referenceNumber=Auth::user()->reference_numbers()->first();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
        ])->get($this->apiUrl . 'project-data/' . $referenceNumber->reference_number);

        return $response;
    }
}
