<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;

class OrderController extends AbstractApiController
{
    public function __construct(OrderService $service, OrderResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    /**
     * @OA\Get(
     *      path="/api/orders",
     *      operationId="index",
     *      tags={"Orders"},
     *      summary="Get list of orders",
     *      description="Returns list of orders",
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
     *      path="/api/orders/{id}",
     *      operationId="show",
     *      tags={"Orders"},
     *      summary="Get order information",
     *      description="Returns order data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Order id",
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
