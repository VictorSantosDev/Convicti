<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Board\BoardController;
use App\Http\Controllers\PointOfSale\PointOfSaleController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'loginAction'])->name('login');
        Route::post('/logout', [AuthController::class, 'logoutAction'])->name('logout');
        Route::middleware('auth:api')->post('/refresh', [AuthController::class, 'refreshAction'])->name('refresh');
        Route::middleware('auth:api')->post('/me', [AuthController::class, 'meAction'])->name('me');
    });

    Route::prefix('sale')->middleware('auth')->group(function () {
        Route::post('/create', [SaleController::class, 'createAction'])->name('create-sale');
        Route::get('/show/{id}', [SaleController::class, 'showAction'])->name('show-sale');
        Route::get('/list', [SaleController::class, 'listAction'])->name('list-sale');
    });

    Route::prefix('user')->middleware('auth')->group(function () {
        Route::get('/list', [UserController::class, 'listAction'])->name('list-user');
    });

    Route::prefix('point-of-sale')->middleware('auth')->group(function () {
        Route::get('/list', [PointOfSaleController::class, 'listAction'])->name('list-user');
    });

    Route::prefix('board')->middleware('auth')->group(function () {
        Route::get('/list', [BoardController::class, 'listAction'])->name('list-user');
    });
});
