<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class RegisterService
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(array $data): User
    {
        $data['status'] = 'new';
        $user = $this->userService->store($data);
        $user->remember_token = Str::random(40);
        $user->save();
        // config('app.debug') ?? SendWelcomeEmail::dispatch($user);
        return $user;
    }

    public function confirmAccount(string $token): User
    {
        $user = $this->getUserByTokenActivation($token);
        if ($user->status == 'active') {
            throw new  \Exception('API.user_already_active', 400);
        }

        $data['status'] = 'active';
        $data['email_verified_at'] = date("Y-m-d H:i:s");
        $user = $this->userService->update($user->id, $data);
        return $user;
    }

    public function getUserByTokenActivation(string $token): User
    {
        $user = $this->userService->findOneBy(['remember_token' => $token]);
        if (!$user) {
            throw new \Exception('API.token_not_found', 404);
        }
        return $user;
    }
}