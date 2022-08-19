<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

//testing solutions routes
Route::get('/fetchCount',[TestController::class,'fetchCountMultipleStatus']);
Route::get('/getLastRec',[TestController::class,'getLastRecFromRelatedModel']);
Route::get('/getPosts',[TestController::class,'getPosts']);

Route::get('/greet', function() {
    return MyFacade::greet2();
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
