<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PisApiRepository;

class PisApiController extends Controller
{
    //
    protected $pisApiRepo;
    public function __construct(PisApiRepository $pisApiRepo){
        $this->pisApiRepo=$pisApiRepo;
    }
    public function getProjectInformation($reference_number){
        return $this->pisApiRepo->getProjectInformation($reference_number);
    }
}
