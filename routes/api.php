<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Api\RegisterController;
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
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'create']);
    Route::get('/confirm-account/{token}', [RegisterController::class, 'confirmAccount']);
});

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::post('/auth/refreshToken', [LoginController::class, 'refreshToken']);
    Route::post('/auth/logout', [LoginController::class, 'logout']);
    
    Route::get('/people', [PersonController::class, 'index']);
    Route::get('/people/{id}', [PersonController::class, 'show']);
    
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::get('/addresses/{id}', [AddressController::class, 'show']);
    
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    
    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/{id}', [ItemController::class, 'show']);
    
    Route::get('/phones', [PhoneController::class, 'index']);
    Route::get('/phones/{id}', [PhoneController::class, 'show']);
});
