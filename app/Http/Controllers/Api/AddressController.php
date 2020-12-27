<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\AddressResource;
use App\Services\AddressService;

class AddressController extends AbstractApiController
{
    public function __construct(AddressService $service, AddressResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    
    /**
     * @OA\Get(
     *      path="/api/addresses",
     *      operationId="index",
     *      tags={"Addresses"},
     *      summary="Get list of addresses",
     *      description="Returns list of addresses",
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
     *      path="/api/addresses/{id}",
     *      operationId="show",
     *      tags={"Addresses"},
     *      summary="Get address information",
     *      description="Returns address data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Address id",
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
