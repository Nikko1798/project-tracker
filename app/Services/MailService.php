<?php

namespace App\Services;
use App\Mail\NewuserCreatemail;
use App\Mail\ForgotPasswordmail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

use Spatie\Permission\Models\Role;
use App\Models\user;
class MailService
{
    public function newUserCreated($request){
        
        $role = Role::findById($request->role);
        $loginId = $role->name!="visitor" ? $request->email : $request->reference_number;
        $data=[
            'app_url' => env('APP_URL'),
            'email' => $request->email,
            'loginId' => $loginId ,
            'password' => $request->password
        ];
        
        Mail::to($data['email'])->send(new NewuserCreatemail($data));
    }
    public function forgotPasswordMail($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        $token = Password::createToken($user);
        $reset_link = url(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ], false));
        $data=[
            'reset_link'=> $reset_link,
        ];

        Mail::to($user->email)->send(new ForgotPasswordmail($data));
    }
     public function PasswordResetMail($request, $user)
    {
        $loginId = $user->hasRole('visitor') ?  $user->reference_number : $user->email;
        $data=[
            'app_url' => env('APP_URL'),
            'email' => $user->email,
            'loginId' => $loginId ,
            'password' => $request->password
        ];

        Mail::to($user->email)->send(new PasswordResetMail($data));
    }
}
