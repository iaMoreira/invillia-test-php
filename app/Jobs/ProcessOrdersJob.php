<?php

namespace App\Jobs;

use App\Services\UploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrdersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $orders;
    private $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orders, $email)
    {
        $this->orders = $orders;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UploadService $uploadService)
    {
        $uploadService->uploadOrders($this->orders, $this->email);
    }
}
