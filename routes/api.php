<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\IikoController;
use App\Http\Controllers\Api\OrdersController;
//use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\SkusController;
use App\Http\Controllers\Api\ExchangeController;
use App\Http\Controllers\Api\Backend\UsersController as BackendUsersController;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

// http://localhost/api/skus?api_token=qGlc3hBKIPVbjVEJb0LAS1duIxXV8Hw5wJncm5c0a5Sr4YfLucLVJXheh2uu
Route::middleware('auth:api')->group(function () {
  Route::get('/skus', [SkusController::class, 'getSkus']);
});

//Route::group(['prefix' => 'backend', 'middleware' => ['auth:api']], function () {
Route::group(['prefix' => 'backend'], function () {

  // Pages
  Route::apiResource('pages', \App\Http\Controllers\Api\Backend\PagesController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
  ]);
  Route::patch('/pages/{id}/change-status', [\App\Http\Controllers\Api\Backend\PagesController::class, 'changeStatus']);

  // Colors
  Route::apiResource('colors', \App\Http\Controllers\Api\Backend\ColorsController::class)->only([
    'index','store','update','destroy'
  ]);

  // Types
  Route::apiResource('types', \App\Http\Controllers\Api\Backend\TypesController::class)->only([
    'index','store','update','destroy'
  ]);

  // Users
   Route::apiResource('users', BackendUsersController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
  ]);
  Route::patch('/users/{id}/change-status', [BackendUsersController::class, 'changeStatus']);
  Route::patch('/users/{id}/change-role', [BackendUsersController::class, 'changeRole']);

  Route::apiResource('messages', \App\Http\Controllers\Api\Backend\MessagesController::class)->only([
    'index','destroy'
  ]);
  Route::get('/messages/count', [\App\Http\Controllers\Api\Backend\MessagesController::class, 'count']);

  Route::apiResource('settings', \App\Http\Controllers\Api\Backend\SettingsController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
  ]);

  // Pages
  Route::apiResource('categories', \App\Http\Controllers\Api\Backend\CategoriesController::class)->only([
    'index','show','store','update','destroy'
  ]);

  // Goods
  Route::get('/goods', [\App\Http\Controllers\Api\Backend\GoodsController::class, 'index']);
  /* Route::get('/users/{id}', [UsersController::class, 'show']);
  Route::post('/users', [UsersController::class, 'store']);
  Route::put('/users/{id}', [UsersController::class, 'update']);
  Route::delete('/users/{id}', [UsersController::class, 'destroy']); */
});

Route::get('/import/parse', [ExchangeController::class, 'parse']);
Route::any('/1c_exchange.php', [ExchangeController::class, 'exchange']);
