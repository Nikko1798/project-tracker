<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;

use App\Repositories\PisApiRepository;

class ApiService
{
    protected $pisApiRepo;
    public function __construct(PisApiRepository $pisApiRepo){
        $this->pisApiRepo=$pisApiRepo;
    }
    public function getPisApiData(){
        $value = Cache::remember('pisData', 30, function () {
            return $this->pisApiRepo->getProjectInformation()->json();
        });
        return $value;
    }
}
