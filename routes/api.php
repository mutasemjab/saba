<?php

namespace App\Http\Controllers\Api\v1\User;
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


Route::group(['prefix' => 'v1/user'], function () {

    // Categories — كل الكاتيجوريز
    Route::get('/categories', [HomeController::class, 'categories']);

    // All Products — للكاش الكامل
    Route::get('/products', [HomeController::class, 'allProducts']);

    // Products by Category
    Route::get('/products/{categoryId}', [HomeController::class, 'productsByCategory']);

    // Settings + About
    Route::get('/settings', [SettingController::class, 'index']);

});

