<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Services\RegisterService;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use ResponseTrait;


    protected $service;
    protected $resource;

    public function __construct(RegisterService $service, UserResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    /**
     * @OA\Post(
     *      path="api/auth/register",
     *      operationId="register",
     *      tags={"Login"},
     *      summary="register",
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
    public function create(RegisterFormRequest $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $user = $this->service->create($data);
            DB::commit();
            return $this->setStatusCode(201)->setMessage("API.welcome_user_send_confirmation_email")->respondWithObject($user, $this->resource);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseErrorException($e);
        }
    }

    public function confirmAccount($token)
    {
        DB::beginTransaction();
        try {
            $user = $this->service->confirmAccount($token);
            DB::commit();
            return $this->setMessage('API.successfully_activated')->respondWithObject($user, $this->resource);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseErrorException($e);
        }
    }
}