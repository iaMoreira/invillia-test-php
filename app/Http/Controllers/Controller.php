<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;



class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Invillia Test Documentation",
     *      description="Main app description",
     *      @OA\Contact(
     *          email="ianmoreira80@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     * 
     * @OA\Tag(
     *     name="Login",
     *     description="API Endpoints of Login"
     * )
     *
     * @OA\Tag(
     *     name="People",
     *     description="API Endpoints of People"
     * )
     * 
     * @OA\Tag(
     *     name="Orders",
     *     description="API Endpoints of Orders"
     * )
     * 
     * @OA\Tag(
     *     name="Phones",
     *     description="API Endpoints of Phones"
     * )
     * 
     * @OA\Tag(
     *     name="Items",
     *     description="API Endpoints of Items"
     * )
     * 
     * @OA\Tag(
     *     name="Addresses",
     *     description="API Endpoints of Addresses"
     * )
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
