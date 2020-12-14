<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ResponseTrait;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    use ResponseTrait;

    /** 
     * @var UploadService $service 
     * description 
     */
    private $service;

    public function __construct(UploadService $service)
    {
        $this->service = $service;
    }

    public function people(Request $request)
    {
        DB::beginTransaction();
        try {
            $people = simplexml_load_file($request->file);
            if (!isset($people->person)) {
                throw new \Exception('Error parser');
            }
            $this->service->uploadPeople($people);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseErrorException($e);
        }

        return redirect()->route('home');
    }

    public function orders(Request $request)
    {
        DB::beginTransaction();
        try {
            $shiporders = simplexml_load_file($request->file);
            if (!isset($shiporders->shiporder)) {
                throw new \Exception('Error parser');
            }
            $this->service->uploadOrders($shiporders);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->route('home');
    }
}
