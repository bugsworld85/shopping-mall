<?php

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

Route::group([], function() {
     Route::post('register', [\App\Http\Controllers\Api\RegisterController::class, 'register'])->name('register.submit');
     Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('login.submit');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('shops', [\App\Http\Controllers\Api\ShopController::class, 'index'])->name('user.shops');
});
