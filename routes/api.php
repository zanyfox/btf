<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\IikoController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\SkusController;

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

//http://localhost/api/skus?api_token=qGlc3hBKIPVbjVEJb0LAS1duIxXV8Hw5wJncm5c0a5Sr4YfLucLVJXheh2uu
/* Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
}); */

// http://localhost/api/skus?api_token=qGlc3hBKIPVbjVEJb0LAS1duIxXV8Hw5wJncm5c0a5Sr4YfLucLVJXheh2uu
Route::middleware('auth:api')->group(function () {
  Route::get('/skus', [SkusController::class, 'getSkus']);
});

