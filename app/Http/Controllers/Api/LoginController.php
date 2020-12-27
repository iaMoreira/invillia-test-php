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

    /**
     * @OA\Post(
     *      path="api/auth/login",
     *      operationId="login",
     *      tags={"Login"},
     *      summary="login",
     *      description="Returns login data",
     *      @OA\RequestBody(
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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

    /**
     * @OA\Post(
     *      path="api/auth/refreshToken",
     *      operationId="refreshToken",
     *      tags={"Login"},
     *      summary="Refresh Token",
     *      description="Returns login data",
     *      @OA\RequestBody(
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function refreshToken()
    {
        try {
            $data = $this->service->refreshToken();
            return $this->responseWithToken($data);
        } catch (\Exception $ex) {
            return $this->responseErrorException($ex);
        }
    }

    /**
     * @OA\Post(
     *      path="api/auth/logout",
     *      operationId="logout",
     *      tags={"Login"},
     *      summary="logout",
     *      description="Logout system.",
     *      @OA\RequestBody(
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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