<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


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

Route::middleware('guest:api')
    ->post('/login', [AuthController::class,'loginUser']);

Route::middleware('guest:api')
    ->post('/signUp', [AuthController::class,'register']);

Route::middleware('auth:api')
    ->get('/logout', [AuthController::class,'logout']);

Route::get('/verifyEmail/{id}',[AuthController::class,'emailVerified']);

Route::middleware('guest:api')
    ->get('/login', function () {
    return response('redirected to login');
    })->name('login');

Route::resource('/users', UserController::class)
    ->except('create')
    ->middleware('auth:api');

Route::resource('/products', ProductController::class)
    ->except('create')
    ->middleware('auth:api');

Route::post('/payment', [PaymentController::class, 'create'])
    ->middleware('auth:api');


