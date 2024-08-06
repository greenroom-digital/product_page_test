<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login()
    {
        $token = $this->service->fakeLogin();
        
        if (!$token) {
            return response()->json('Failed to login!', Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $token,
        ], Response::HTTP_OK);
    }
}
