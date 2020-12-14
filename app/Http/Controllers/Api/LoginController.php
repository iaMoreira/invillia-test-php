<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    use ResponseTrait;

    /**
     * @var LoginService
     */
    private $service;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $data = $this->service->login($credentials);
            return $this->responseWithToken($data);
        } catch (\Exception $e) {
            return $this->responseErrorException($e);
        }
    }

    public function refreshToken()
    {
        try {
            $data = $this->service->refreshToken();
            return $this->responseWithToken($data);
        } catch (\Exception $ex) {
            return $this->responseErrorException($ex);
        }
    }

    public function logout()
    {
        try {
            $this->service->logout();
            return $this->setMessage('API.logout')->setStatusCode(204)->respond();
        } catch (\Exception $ex) {
            return $this->responseErrorException($ex);
        }
    }
}