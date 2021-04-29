<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController; 

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

Route::resource('category', CategoryController::class);



Route::group(['middleware'=>'auth:sanctum'], function(){
	Route::get('data/view/{id?}', [TestApiController::class, 'view']);
	Route::post('data/store', [TestApiController::class, 'store']);
	Route::put('data/update', [TestApiController::class, 'update']);
	Route::delete('data/delete/{id}', [TestApiController::class, 'delete']);
	Route::get('data/search/{param}', [TestApiController::class, 'search']);

	// blog route
	Route::apiResource('blog', BlogController::class);
});


Route::post('login', [UserController::class, 'login']);