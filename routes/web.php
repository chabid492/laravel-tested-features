<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('test',[TestController::class,'index']);

Route::get('/greet', function() {
    return MyFacade::greet2();
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
