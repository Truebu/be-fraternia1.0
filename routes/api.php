<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VacantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/login',[UserController::class,'login']);
Route::post('/user/signup',[UserController::class,'signup']);
Route::put('/user/recovery/{id}',[UserController::class,'update']);
Route::post('/user/recovery',[UserController::class,'recovery']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/user', [UserController::class,'index']);
    Route::post('/user/logout',[UserController::class,'logout']);
    Route::get('/post/list', [PostController::class,'index']);
    Route::post('/post/topost',[PostController::class,'store']);
    Route::post('/vacant/tovacant',[VacantController::class,'store']);
    Route::get('/vacant/list',[VacantController::class,'index']);
    Route::post('/company/signup',[CompanyController::class,'store']);
    Route::get('/company/exist',[CompanyController::class,'isExistCompany']);
});
