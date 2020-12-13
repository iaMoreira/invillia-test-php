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
}
