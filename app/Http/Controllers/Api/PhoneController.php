<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\PhoneResource;
use App\Services\PhoneService;

class PhoneController extends AbstractApiController
{
    public function __construct(PhoneService $service, PhoneResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    /**
     * @OA\Get(
     *      path="/api/phones",
     *      operationId="index",
     *      tags={"Phones"},
     *      summary="Get list of phones",
     *      description="Returns list of phones",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index(): \Illuminate\Http\JsonResponse {
        return parent::index();
    }

    /**
     * @OA\Get(
     *      path="/api/phones/{id}",
     *      operationId="show",
     *      tags={"Phones"},
     *      summary="Get phone information",
     *      description="Returns phone data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Phone id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(int $id): \Illuminate\Http\JsonResponse {
        return parent::show($id);
    }
}