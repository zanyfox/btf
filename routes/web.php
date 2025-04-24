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
Route::get('/backend/{view}', BackendController::class)->where('view', '(.*)')->name('app');

//Route::get('{any?}', fn () => view('app'))->where('any', '.*');

if( !request()->cookie('age_limit') ) {
  Route::get('/{any}', function () {
    return view('welcome');
  })->where('any', '.*');
}

Route::get('/', HomeController::class)->name('home');
Route::get('catalog', [CatalogController::class, 'index'])->name('catalog');
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
