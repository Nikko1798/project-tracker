<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PisApiRepository;
use App\Services\ApiService;

class PisApiController extends Controller
{
    //
    protected $pisApiRepo;
    protected $apiService;
    public function __construct(PisApiRepository $pisApiRepo, ApiService $apiService){
        $this->pisApiRepo=$pisApiRepo;
        $this->apiService=$apiService;
    }
    public function getProjectInformation(){
        // return $this->pisApiRepo->getProjectInformation();
        return $this->apiService->getPisApiData();
    }
}
