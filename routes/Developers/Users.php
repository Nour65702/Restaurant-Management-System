<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\MenuItemController;
use App\Http\Controllers\Api\Admin\RestaurantController;
use App\Http\Controllers\Auth\User\AuthController;
use Illuminate\Support\Facades\Route;


// User routes
Route::prefix('user')->group(function () {
    // Authentication routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::post('send-otp', [AuthController::class, 'sendOtp']);
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::middleware('auth:sanctum')->group(function () {
        // Logout route
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('menu-items', [MenuItemController::class, 'index']);
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('restaurants', [RestaurantController::class, 'index']);
    });
});
