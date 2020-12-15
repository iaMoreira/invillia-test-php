<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ResponseTrait;
use App\Jobs\ProcessOrdersJob;
use App\Jobs\ProcessPeopleJob;
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
            $people = json_decode(json_encode($people));
            $email = $request->email;
            $this->dispatch((new ProcessPeopleJob($people, $email))->onQueue('uploading'));
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
            $shiporders = json_decode(json_encode($shiporders));
            $email = $request->email;
            
            $this->dispatch((new ProcessOrdersJob($shiporders, $email))->onQueue('uploading'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseErrorException($e);
        }

        return redirect()->route('home');
    }
}
