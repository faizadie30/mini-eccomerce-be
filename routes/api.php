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

Route::apiResource('/products', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('/transactions', App\Http\Controllers\Api\CartController::class);
Route::post('/images', [App\Http\Controllers\Api\ImageController::class, 'store']);
