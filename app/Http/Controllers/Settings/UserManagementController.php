<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\Settings\UserProfileUpdateRequest;
use App\Models\User;

use App\Repositories\UserRepository;
use App\Services\UserManagementService;
class UserManagementController extends Controller
{
    //
    protected $userRepository;
    protected $userManagement;
    public function __construct(UserRepository $userRepository, UserManagementService $userManagement){
        $this->userRepository=$userRepository;
        $this->userManagement=$userManagement;
    }
    public function index():Response{
        
        if((Auth::user()->hasRole('super-admin')) || (Auth::user()->hasRole('admin'))){
            return Inertia::render('settings/UserManagement');
        }
        else {
            abort(403);
        }
    }
    public function allUsers(Request $request){
        return $this->userRepository->allUsers($request);
    }
    public function resetPassword(Request $request,User $user)
    {
        return $this->userManagement->resetPassword( $request, $user);
        // return $this->userRepository->resetPassword($validated, $user);
    }
    public function updateUserProfile(UserProfileUpdateRequest $request,User $user)
    {
        return $this->userRepository->updateUserProfile($request, $user);
    }
    public function getUserReferenceNumber(User $user)
    {
        return $this->userRepository->getUserReferenceNumber($user);
    }
}
