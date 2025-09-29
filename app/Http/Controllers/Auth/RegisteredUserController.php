<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReferenceNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        
        if((Auth::user()->hasRole('super-admin')) || (Auth::user()->hasRole('admin'))){
            $roles=Role::all();
            return Inertia::render('auth/Register', [
                'roles'=>$roles
            ]);
        }
        else{
            abort (403);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            if (Auth::user()->hasRole('super-admin')) {
                $rules['role'] = ['required', 'integer'];
                $rules['reference_number'] = ['nullable|string|max:255|unique:'.ReferenceNumber::class];
                
            } else {
                $rules['role'] = ['nullable', 'integer']; // optional for others
                $rules['reference_number'] = ['required|string|max:255|unique:'.ReferenceNumber::class];
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->reference_numbers()->createMany([
                ['reference_number' => $request->reference_number],
            ]);
            
            if(Auth::user()->hasRole('super-admin'))
            {
                
                $role = Role::findById($request->role);
                $user->assignRole($role);
            }
            else{
                
                $user->assignRole('visitor');
            }
            event(new Registered($user));

            Auth::login($user);

            return to_route('dashboard');
        });
    }
}
