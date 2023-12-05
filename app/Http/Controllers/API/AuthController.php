<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $user = $this->authService->login($credentials);

        if ($user) {
            return response()->json([
                'message' => 'Berhasil login',
                'data' => $user,
            ]);
        }

        return response()->json([
            'message' => 'Gagal login',
        ], 401);
    }

    public function register(AuthRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $user = $this->authService->register($data);

        if ($user) {
            return response()->json([
                'message' => 'Berhasil register',
                'data' => $user,
            ]);
        }

        return response()->json([
            'message' => 'Gagal register',
        ], 401);
    }

    public function logout(AuthRequest $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return response()->json([
            'message' => 'Berhasil logout',
        ]);
    }
}
