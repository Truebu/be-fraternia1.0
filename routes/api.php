<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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
});
