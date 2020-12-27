<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ItemResource;
use App\Services\ItemService;

class ItemController extends AbstractApiController
{
    public function __construct(ItemService $service, ItemResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    /**
     * @OA\Get(
     *      path="/items",
     *      operationId="index",
     *      tags={"Items"},
     *      summary="Get list of items",
     *      description="Returns list of items",
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
     *      path="/items/{id}",
     *      operationId="show",
     *      tags={"Items"},
     *      summary="Get item information",
     *      description="Returns item data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Item id",
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
