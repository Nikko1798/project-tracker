<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserRepository
{
    public function allUsers($request)
    {
        $perPage = $request->input('perPage', 10); // Default to 10 per page
        $page = $request->input('page', 1); // Default page 1

        $users=User::select('users.id','users.name', 'users.email')
        ->with('reference_numbers')
        ->where(function ($query) use ($request){
            $query->where('users.name', 'like', '%' . $request->name . '%')
            ->orWhere('users.email', 'like', '%' . $request->name . '%')
            ->orWhereHas('reference_numbers', function ($query) use ($request) {
                $query->where('reference_number', 'like', '%' . $request->name . '%');
            });
        });

        if(isset($request->sortBy))
        {
            $users->orderBy($request->sortBy, $request->sortOrder);
        }


        return $users->paginate($perPage, ['*'], 'page', $page);
    }
    public function getUserReferenceNumber($user){
        return $user->reference_numbers();
    }
    public function resetPassword($request, $user)
    {
        try{
            $updatedUser=$user->update([
                'password' => Hash::make($request['password']),
            ]);
            return response()->json([
                'success' => true,
                'message' => "Password Successfully updated.",
                'data' => null
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'error' => null
                ], 500);
        }
    }
    public function updateUserProfile($request, $user)
    {
        try{
            $updatedUser=$user->update([
                'name'=>$request['name'],
                'email'=>$request['email']
            ]);
            return response()->json([
                'success' => true,
                'message' => "Profile Successfully updated.",
                'data' => null
            ], 200);
        
        }
        catch(Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => $e->getMessage()
            ], 500);
        }
        
    }

}
