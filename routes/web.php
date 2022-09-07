<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Profila\SocialLoginController;


//stateless login
Route::get('socialLogin',function (){
    return view('social');
});

Route::post('social/{provider}', [SocialLoginController::class, 'redirect']);
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback']);

//social login
Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle']);
//Route::get('auth/{google}/callback', [SocialLoginController::class, 'handleGoogleCallback']);

//testing solutions routes

Route::get('/userOrderBy',[TestController::class,'userOrderBy']);

Route::get('/searchMultipleScope',function (){
    return view('test.posts');
});
Route::post('/searchMultipleScopeSearch',[TestController::class,'searchMultipleScopeSearch']);

Route::get('/authorOfComment',[TestController::class,'authorOfComment']);
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
