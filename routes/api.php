<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoodsController;
use App\Http\Controllers\Api\ExchangeController;

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

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });
});

// php artisan r:l
Route::apiResource('goods', GoodsController::class);

Route::get('/import/parse', [ExchangeController::class, 'parse']);
Route::any('/1c_exchange.php', [ExchangeController::class, 'exchange']);
