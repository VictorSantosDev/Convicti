<?php

use App\Http\Controllers\Auth\AuthController;
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
        Route::post('login', [AuthController::class, 'loginAction'])->name('login');
        Route::post('logout', [AuthController::class, 'logoutAction'])->name('logout');
        Route::middleware('auth:api')->post('refresh', [AuthController::class, 'refreshAction'])->name('refresh');
        Route::middleware('auth:api')->post('me', [AuthController::class, 'meAction'])->name('me');
    });
});

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    
});