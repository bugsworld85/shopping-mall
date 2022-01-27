<?php

use App\Http\Controllers\Api\OwnerShopController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {
    Route::post('register', [\App\Http\Controllers\Api\RegisterController::class, 'register'])->name('register.submit');
    Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('login.submit');
    Route::get('logout',);

    Route::get('shop/{shop}/visit', [ShopController::class, 'triggerVisit'])->name('trigger.visit');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::group(['middleware' => ['only.json']], function () {

        Route::get('roles', [\App\Http\Controllers\Api\RoleController::class, 'index'])->name('roles');

        Route::group(['middleware' => ['allowed.role:super_admin']], function () {

            Route::get('users', [UserController::class, 'index'])->name('users');
            Route::post('user/create', [UserController::class, 'create'])->name('user.create');
            Route::get('user/{user}/view', [UserController::class, 'view'])->name('user.view');
            Route::put('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::delete('user/{user}', [UserController::class, 'delete'])->name('user.delete');
        });


        Route::group(['middleware' => ['allowed.role:super_admin,mall_manager']], function () {
            Route::get('shops', [ShopController::class, 'index'])->name('shops');
            Route::post('shop/create', [ShopController::class, 'create'])->name('shop.create');
            Route::get('shops/visits', [ShopController::class, 'visitsPerShopReport'])->name('shops.visits.report');
        });

        Route::group(['middleware' => ['allowed.role:store_owner']], function () {
            Route::get('user/shops', [OwnerShopController::class, 'index'])->name('user.shops');
            Route::get('user/shop/active', [OwnerShopController::class, 'activeShop'])->name('user.shop.active');

            Route::group(['middleware' => ['verify.owner']], function () {
                Route::get('user/shop/{shop}/active', [OwnerShopController::class, 'makeShopActive'])->name('user.shop.make.active');
                Route::get('user/shop/{shop}/visits', [OwnerShopController::class, 'visitsPerDayReport'])->name('user.shop.visits.report.perday');
            });
        });
    });
});
