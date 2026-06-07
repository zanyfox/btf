<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\SendController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\BackendController;

use App\Mail\WelcomeMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Backend
Route::get('/backend/{view}', BackendController::class)->where('view', '(.*)')->middleware('auth');

//Route::group(['prefix' => 'api/backend', 'middleware' => ['auth','AdminCheck']], function () {
Route::group(['prefix' => 'api/backend'], function () {

  Route::get('stats/orders', [\App\Http\Controllers\Backend\StatsController::class, 'orders']);
  Route::get('stats/customers', [\App\Http\Controllers\Backend\StatsController::class, 'customers']);

  // Pages
  Route::apiResource('pages', \App\Http\Controllers\Backend\PagesController::class)->only([
    'index','show','store','update','destroy'
  ]);
  Route::patch('/pages/{id}/change-status', [\App\Http\Controllers\Backend\PagesController::class, 'changeStatus']);

  // Posts
  Route::patch('posts/bulk-ban', [\App\Http\Controllers\Backend\PostsController::class, 'bulkBan']);
  Route::patch('posts/bulk-unban', [\App\Http\Controllers\Backend\PostsController::class, 'bulkUnban']);
  Route::patch('posts/{id}/change-status', [\App\Http\Controllers\Backend\PostsController::class, 'changeStatus']);
  Route::apiResource('posts', \App\Http\Controllers\Backend\PostsController::class)->only(['index','show','store','update','destroy']);

  // Rubrics
  Route::apiResource('rubrics', \App\Http\Controllers\Backend\RubricsController::class)->only(['index','show','store','update','destroy']);

  // Colors
  Route::apiResource('colors', \App\Http\Controllers\Backend\ColorsController::class)->only([
    'index','store','update','destroy'
  ]);

  // Types
  Route::apiResource('types', \App\Http\Controllers\Backend\TypesController::class)->only([
    'index','store','update','destroy'
  ]);

  // Users
  Route::patch('/users/bulk-ban', [\App\Http\Controllers\Backend\UsersController::class, 'bulkBan']);
  Route::patch('/users/bulk-unban', [\App\Http\Controllers\Backend\UsersController::class, 'bulkUnban']);
  Route::patch('/users/{id}/change-status', [\App\Http\Controllers\Backend\UsersController::class, 'changeStatus']);
  Route::get('/users/profile', [\App\Http\Controllers\Backend\UsersController::class, 'profile']);
  Route::apiResource('users', \App\Http\Controllers\Backend\UsersController::class)->only(['index','show','store','update','destroy']);

  // Profile
  Route::get('profile/index', [\App\Http\Controllers\Backend\ProfileController::class, 'index']);
  Route::put('profile', [\App\Http\Controllers\Backend\ProfileController::class, 'update']);
  Route::post('profile/upload-picture', [\App\Http\Controllers\Backend\ProfileController::class, 'uploadPicture']);
  Route::delete('profile/remove-picture', [\App\Http\Controllers\Backend\ProfileController::class, 'removePicture']);

  // Roles
  Route::apiResource('roles', \App\Http\Controllers\Backend\RolesController::class)->only(['index','show','store','update','destroy']);

  // Roles
  Route::apiResource('permissions', \App\Http\Controllers\Backend\PermissionsController::class)->only(['index','show','store','update','destroy']);



  Route::apiResource('messages', \App\Http\Controllers\Backend\MessagesController::class)->only(['index','destroy']);
  Route::get('/messages/message-statuses', [\App\Http\Controllers\Backend\MessagesController::class, 'messageStatuses']);

  Route::apiResource('settings', \App\Http\Controllers\Backend\SettingsController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
  ]);

  // Categories
  Route::apiResource('categories', \App\Http\Controllers\Backend\CategoriesController::class)->only([
    'index','show','store','update','destroy'
  ]);
  Route::patch('categories/{id}/change-status', [\App\Http\Controllers\Backend\CategoriesController::class, 'changeStatus']);

  // Goods
  Route::get('/goods', [\App\Http\Controllers\Backend\GoodsController::class, 'index']);
  /* Route::get('/users/{id}', [UsersController::class, 'show']);
  Route::post('/users', [UsersController::class, 'store']);
  Route::put('/users/{id}', [UsersController::class, 'update']);
  Route::delete('/users/{id}', [UsersController::class, 'destroy']); */

});
//Route::get('{any?}', fn () => view('app'))->where('any', '.*');

if( !request()->cookie('age_limit') ) {
  Route::get('/{any}', function () {
    return view('welcome');
  })->where('any', '.*');
}

Route::get('/', HomeController::class)->name('home');
Route::get('catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('catalog/{category}', [CatalogController::class, 'category'])->name('category');
Route::get('catalog/{category}/{id}', [CatalogController::class, 'details'])->whereNumber('id')->name('details');
Route::get('about', [PagesController::class, 'about'])->name('about');
Route::get('about-tobacco', function() {
  return '<div class="title-box__bg">
      <h2 class="title-text">О табаке</h2>
      <div class="bg-title">Tobacco</div>
    </div>
    <div class="about-tobacco__banner">
      <div class="content-box one">
        <p>
          Продукт создается исключительно из высококачественных сортов табака в соответствии с мировыми стандартами
        </p>
      </div>
      <div class="content-box two">
        <p>
          Продукция Балтийской табачной фабрики продается на территории всей России, а также в странах СНГ.
        </p>
      </div>
      <div class="content-box three">
        <p>
          Оценку качества, вкуса и аромата табачных изделий проводят специально обученные дегустаторы
        </p>
      </div>
      <div class="content-box four">
        <p>
          Все табачные изделия фабрики соответствуют требованиям Технического регламента на табачную продукцию
        </p>
      </div>
    </div>';
});
Route::get('contacts', [PagesController::class, 'contacts'])->name('contacts');
Route::post('send', SendController::class)->name('send');
Route::get('distributors', [PagesController::class, 'distributors']);
Route::get('politika-konfidentsialnosti', [\App\Http\Controllers\PagesController::class, 'privacy'])->name('receiver');
Route::get('polzovatelskoe-soglashenie', [\App\Http\Controllers\PagesController::class, 'userAgreement'])->name('receiver');

//require __DIR__.'/auth.php';
