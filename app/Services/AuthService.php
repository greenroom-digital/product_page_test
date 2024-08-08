<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * FAKE-Authenticate a user
     * 
     */
    public function fakeLogin()
    {
        $user = User::first();
        
        Auth::login($user);

        $token = Auth::user()->createToken('authToken')->plainTextToken;

        return $token;
    }
}
