<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PisApiRepository;
use App\Services\ApiService;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Traits\HasRoles;
class DashboardController extends Controller
{
    //
     protected $apiService;
    public function __construct(ApiService $apiService){
        $this->apiService=$apiService;
    }
    public function dashboard(): Response{

        if((Auth::user()->hasRole('super-admin')) || (Auth::user()->hasRole('admin')))
        {
            return Inertia::render('Dashboard');
        }
        else{
               return Inertia::render('VisitorDashboard', [
                    'pisData'=>  $this->apiService->getPisApiData()
            ]);
        }
    }
}
