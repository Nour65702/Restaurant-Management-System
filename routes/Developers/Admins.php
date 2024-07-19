<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\MenuItemController;
use App\Http\Controllers\Api\Admin\RestaurantController;
use App\Http\Controllers\Auth\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// Admin authentication routes
Route::prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {   
        Route::post('logout', [AuthController::class, 'logout']);
        Route::apiResource('restaurants', RestaurantController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('menu-items', MenuItemController::class);
 
    });
});
