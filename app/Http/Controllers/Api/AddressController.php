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
}
