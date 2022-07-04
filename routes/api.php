<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RegisterController;
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
Route::group(['prefix' => '', 'middleware' => 'throttle:60,1'], function () {

Route::post('auth/login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
    Route::post('/image_upload',[ProductController::class,'imageUpload'])->name('image_upload');
});

Route::resource('carts', CartController::class);

});