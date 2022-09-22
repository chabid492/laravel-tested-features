<?php

namespace App\Http\Controllers\Angular;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AngularController extends Controller
{
    public function angular_app_home(){
        View::addExtension('html','php');
        return View::make('test_angular.home');
    }
}
