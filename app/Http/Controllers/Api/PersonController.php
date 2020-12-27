<?php

namespace App\Http\Controllers\Api;

use App\Services\PersonService;
use App\Http\Resources\PersonResource;

class PersonController extends AbstractApiController
{
 
    public function __construct(PersonService $service, PersonResource $resource)
    {
        $this->service = $service;
        $this->resource = $resource;
    }

    /**
     * @OA\Get(
     *      path="/api/people",
     *      operationId="index",
     *      tags={"People"},
     *      summary="Get list of people",
     *      description="Returns list of people",
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
     *      path="/api/people/{id}",
     *      operationId="show",
     *      tags={"People"},
     *      summary="Get peson information",
     *      description="Returns peson data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Peson id",
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
