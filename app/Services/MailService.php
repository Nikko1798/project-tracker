<?php

namespace App\Services;
use App\Mail\NewuserCreatemail;
use Illuminate\Support\Facades\Mail;

use Spatie\Permission\Models\Role;
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
}
