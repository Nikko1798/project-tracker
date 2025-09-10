<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Http;
class PisApiRepository
{
    private $apiToken;
    private $apiUrl;
    
    public function __construct()
    {
        $this->apiToken = env('PIS_API_TOKEN');
        $this->apiUrl   = env('PIS_API_ROOT_URL');
    }
    public function getProjectInformation($reference_number){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
        ])->get($this->apiUrl . 'project-data');

        return $response;
    }
}
