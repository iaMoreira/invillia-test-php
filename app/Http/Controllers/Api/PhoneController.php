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
}