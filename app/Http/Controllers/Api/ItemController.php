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
}
