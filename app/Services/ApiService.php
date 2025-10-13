<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PisApiRepository;

class ApiService
{
    protected $pisApiRepo;
    public function __construct(PisApiRepository $pisApiRepo){
        $this->pisApiRepo=$pisApiRepo;
    }
    public function getPisApiData(){
        try{
            
            $value = Cache::remember('pisApiData'. Auth::user()->reference_numbers()->first(), 30, function () {
                return $this->pisApiRepo->getProjectInformation()->json();
            });
            return $value;
        
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
