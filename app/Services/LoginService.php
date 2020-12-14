<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService 
{
    public function login(array $credentials): array
    {
        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            throw new \Exception('API.invalid_email_password', 400);
        }

        $data['user'] = auth()->user();
        $data['expires_in'] = config('jwt.ttl');
        $data['token'] = $token;
        $data['token_type'] = 'bearer';

        return $data;
    }

    public function refreshToken(): array
    {
        $oldToken = JWTAuth::getToken();
        $newToken = JWTAuth::refresh($oldToken);

        $data['user'] = auth()->user();
        $data['expires_in'] = config('jwt.ttl');
        $data['token'] = $newToken;
        $data['token_type'] = 'bearer';

        return $data;
    }

    public function logout(): void
    {
        JWTAuth::invalidate();
    }
}