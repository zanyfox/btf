<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\GoodsController as AdminGoodsController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;
use App\Http\Controllers\Admin\PostsController as AdminPostsController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\FeaturesController as AdminFeaturesController;

Route::get('login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('authenticate', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware(['auth','isAdmin','role:super-admin|admin'])->name('admin.')->group(function() {

  Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
  Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
  Route::get('/clear-cache', [\App\Http\Controllers\Admin\DashboardController::class, 'clearCache'])->name('clearCache');
  Route::get('/storage-link', [\App\Http\Controllers\Admin\DashboardController::class, 'storageLink'])->name('storageLink');
  Route::get('seed-goods', [\App\Http\Controllers\Admin\DashboardController::class, 'seedGoods'])->name('seedGoods');
  Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

  // Incomming Messages
  Route::get('messages', [\App\Http\Controllers\Admin\MessagesController::class, 'index'])->name('adminMessages');
  Route::get('messages/{id}', [\App\Http\Controllers\Admin\MessagesController::class, 'show'])->whereNumber('id');

  Route::get('posts', [AdminPostsController::class, 'index']);//->middleware(['can:isAdmin, App\Models\Post']);
  Route::get('posts/create', [AdminPostsController::class, 'create']);
  Route::post('posts/store', [AdminPostsController::class, 'store']);
  Route::get('posts/{id}/edit', [AdminPostsController::class, 'edit'])->where('id', '[0-9]+');
  Route::put('posts/{id}', [AdminPostsController::class, 'update'])->where('id', '[0-9]+');
  Route::delete('posts/delete/{id}', [AdminPostsController::class, 'delete'])
    ->middleware(['can:isAdmin, App\Models\Post'])
    //->middleware(['permission:delete-post'])
    ->whereNumber('id');

  Route::resource('rubrics', \App\Http\Controllers\Admin\RubricsController::class);

  Route::resource('users', \App\Http\Controllers\Admin\UsersController::class)->middleware(['role:super-admin']);
  Route::middleware(['role:super-admin'])->group(function() {
    Route::resource('roles', AdminRolesController::class);
    Route::get('roles/{id}/give-permissions', [AdminRolesController::class, 'givePermissions'])->whereNumber('id');
    Route::put('roles/{id}/give-permissions', [AdminRolesController::class, 'givePermissions'])->whereNumber('id');
  });
  Route::resource('permissions', \App\Http\Controllers\Admin\PermissionsController::class)->middleware(['role:super-admin']);

  Route::resource('services', \App\Http\Controllers\Admin\ServicesController::class);

  Route::resource('galleries', \App\Http\Controllers\Admin\GalleriesController::class);
  Route::get('galleries/{id}/deleteimage', [\App\Http\Controllers\Admin\GalleriesController::class, 'deleteimage']);
  Route::get('galleries/sortimage/{id}/{sort}', [\App\Http\Controllers\Admin\GalleriesController::class, 'sort'])->whereNumber('id')->whereNumber('sort');

  Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class);
  Route::get('categories/{id}/remove-picture', [\App\Http\Controllers\Admin\CategoriesController::class, 'removePicture'])->whereNumber('id');
  Route::get('categories/{id}/change-status', [\App\Http\Controllers\Admin\CategoriesController::class, 'changeStatus'])->whereNumber('id');


  Route::resource('pages', \App\Http\Controllers\Admin\PagesController::class);

  Route::resource('brands', \App\Http\Controllers\Admin\BrandsController::class);
  Route::get('brands/{id}/remove-picture', [\App\Http\Controllers\Admin\BrandsController::class, 'removePicture'])->whereNumber('id');
  Route::get('brands/change-status/{id}', [\App\Http\Controllers\Admin\BrandsController::class, 'changeStatus'])->whereNumber('id');

  Route::resource('partners', \App\Http\Controllers\Admin\PartnersController::class);
  Route::get('partners/{id}/remove-picture', [\App\Http\Controllers\Admin\PartnersController::class, 'removePicture'])->whereNumber('id');
  Route::get('partners/change-status/{id}', [\App\Http\Controllers\Admin\PartnersController::class, 'changeStatus'])->whereNumber('id');

  Route::resource('mainslider', \App\Http\Controllers\Admin\MainsliderController::class);
  Route::get('mainslider/{id}/remove-image/{type}', [\App\Http\Controllers\Admin\MainsliderController::class, 'removeImage'])->whereNumber('id');
  Route::resource('colors', \App\Http\Controllers\Admin\ColorsController::class);
  Route::resource('types', \App\Http\Controllers\Admin\TypesController::class);
  Route::resource('reviews', \App\Http\Controllers\Admin\ReviewsController::class);

  Route::resource('merchants', \App\Http\Controllers\Admin\MerchantsController::class);
  Route::get('merchants/{merchant}/update-token/', [\App\Http\Controllers\Admin\MerchantsController::class, 'updateToken'])->name('merchants.updateToken');

  Route::post('upload', \App\Http\Controllers\Admin\UploadController::class)->name('adminUpload');
  
  Route::resource('goods', AdminGoodsController::class, ['except' => ['show']]);
  Route::match(['GET','POST'], 'goods/import', [AdminGoodsController::class, 'import']);
  Route::get('goods/export/{format?}', [AdminGoodsController::class, 'export']);
  Route::get('goods/{id}/remove-picture/{pictureId}', [AdminGoodsController::class, 'removePicture'])->whereNumber('id')->whereNumber('pictureId');
  Route::delete('goods/{goodId}/remove-good-feature/{featureId}', [AdminGoodsController::class, 'removeGoodFeature'])->whereNumber('goodId')->whereNumber('featureId');
  Route::any('goods/{id}/changestatus', [AdminGoodsController::class, 'changestatus'])->whereNumber('id');
  
  Route::resource('orders', AdminOrdersController::class);
  Route::patch('orders/change-status/{id}', [AdminOrdersController::class, 'changeStatus'])->whereNumber('id');
  Route::patch('orders/restore/{id}', [AdminOrdersController::class, 'restore'])->middleware(['can:isAdmin'])->whereNumber('id')->name('orders.restore');
  Route::get('orders/view-invoice/{id}', [AdminOrdersController::class, 'viewInvoice'])->whereNumber('id');
  Route::get('orders/download-invoice/{id}', [AdminOrdersController::class, 'downloadInvoice'])->whereNumber('id');
  Route::get('orders/send-invoice/{id}', [AdminOrdersController::class, 'sendInvoice'])->whereNumber('id');
  Route::get('orders/export', [AdminOrdersController::class, 'export']);
  
  Route::resource('discounts', \App\Http\Controllers\Admin\DiscountsController::class);
  Route::resource('coupons', \App\Http\Controllers\Admin\CouponsController::class);
  Route::resource('delivery-methods', \App\Http\Controllers\Admin\DeliveryMethodsController::class);
  Route::resource('payment-methods', \App\Http\Controllers\Admin\PaymentMethodsController::class);

  Route::group(['middleware' => ['permission:show-payments']], function() {
    Route::get('payments', [\App\Http\Controllers\Admin\PaymentsController::class, 'index']);
    Route::get('payments/{id}', [\App\Http\Controllers\Admin\PaymentsController::class, 'show'])->whereNumber('id');
    Route::get('payments/get-payment-info/{id}', [\App\Http\Controllers\Admin\PaymentsController::class, 'getPaymentInfo'])->whereNumber('id');
  });
  

  Route::controller(\App\Http\Controllers\Admin\SettingsController::class)->group(function() {
    Route::get('settings', 'index');
    Route::get('settings/load', 'load');
    Route::post('settings/store', 'store');
    Route::post('settings/update/{id}', 'update');
    Route::get('settings/show/{id}', 'show');
    Route::get('settings/delete/{id}', 'delete')->whereNumber('id');
  });


  Route::controller(\App\Http\Controllers\Admin\CalendarController::class)->group(function() {
    Route::get('calendar', 'index');
    Route::get('calendar/{id}', 'show')->whereNumber('id');
    Route::post('calendar', 'store');
    Route::put('calendar/{id}', 'update')->whereNumber('id');
    Route::delete('calendar/{id}', 'destroy')->whereNumber('id');
  });

  Route::get('logs/products/{id?}', [\App\Http\Controllers\Admin\LogsController::class, 'products']);
  Route::get('logs/groups/{id?}', [\App\Http\Controllers\Admin\LogsController::class, 'groups']);
  Route::get('logs/orders', [\App\Http\Controllers\Admin\LogsController::class, 'orders']);
  Route::get('logs/activity', [\App\Http\Controllers\Admin\LogsController::class, 'activity']);

  Route::get('features', [AdminFeaturesController::class, 'index']);
  Route::get('features/load', [AdminFeaturesController::class, 'load']);
  Route::get('features/load/{id}', [AdminFeaturesController::class, 'details'])->whereNumber('id');
  Route::post('features/store', [AdminFeaturesController::class, 'store']);
  Route::put('features/update/{id}', [AdminFeaturesController::class, 'update'])->whereNumber('id');
  Route::delete('features/destroy/{id}', [AdminFeaturesController::class, 'destroy'])->whereNumber('id');

});
