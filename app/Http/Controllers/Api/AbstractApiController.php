<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

abstract class AbstractApiController extends Controller
{
    use ResponseTrait;
    
    /**
     * Instance that extends Illuminate\Http\Resources\Json\JsonResource
     *
     * @var \App\Services\AbstractService
     */
    protected $service;

    /**
     * Instance that extends Illuminate\Http\Resources\Json\JsonResource
     *
     * @var Illuminate\Http\Resources\Json\JsonResource
     */
    protected $resource;

    public function index()
    {
        $items = $this->service->getAllPaginate();
        return $this->respondWithCollection($items, $this->resource);
    }

    public function show($id)
    {
        $item = $this->service->getOne($id);

        if ($item) {
            return $this->respondWithObject($item, $this->resource);
        } else {
            return $this->responseNotFound(['id' => $id]);
        }
    }

}