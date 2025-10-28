<?php

namespace App\Services;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

use App\Repositories\UserRepository;

use App\Services\MailService;
class UserManagementService
{

    protected $userRepository;
    protected $mailService;
    public function __construct(UserRepository $userRepository, MailService $mailService){
        $this->userRepository=$userRepository;
        $this->mailService=$mailService;
    }
    public function resetPassword( $request, $user)
    {
        try{
            return DB::transaction(function () use ($request, $user){

                $validated = $request->validate([
                    'password' => ['required', Password::defaults(), 'confirmed'],
                ]);
                
                $this->userRepository->resetPassword($validated, $user);
                $this->mailService->PasswordResetMail($request, $user);
                return response()->json([
                    'success' => true,
                    'message' => "Password Successfully updated.",
                    'data' => null
                ], 200);
            });
        }
        catch(Exeption $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
