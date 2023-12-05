<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    public function login(array $credentials): bool|array
    {
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $credentials['email'])->first();
            $token = $this->generateToken($user)->accessToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        }

        return false;
    }

    public function register(array $data): bool|array
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $token = $this->generateToken($user)->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    private function generateToken(User $user): NewAccessToken
    {
        return $user->createToken("API Token");
    }
}
