<?php

namespace App\Http\Controllers\Angular;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AngularController extends Controller
{
    public function angular_app_home(){
        return view('test_angular.home');
    }
}
