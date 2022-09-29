<?php

namespace App\Http\Controllers\JobController;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationJob;
use Illuminate\Http\Request;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\Facades\Log;

class NotifyController extends Controller
{
    public function index(QueueManager $queueManager){
        Log::channel('abid')->info('Queue Driver is= '. $queueManager->getDefaultDriver());
        NotificationJob::dispatch();
        return "job running";
    }
}
