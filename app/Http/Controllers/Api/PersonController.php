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
}
