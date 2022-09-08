<?php

namespace App\Http\Controllers\JobController;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationJob;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function index(){
        NotificationJob::dispatchAfterResponse();
        return "job running";
    }
}
