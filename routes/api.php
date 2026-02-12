<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantTableController;


Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::apiResource('foods', FoodController::class);

        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{order}', [OrderController::class, 'show']);
        Route::post('/orders/open', [OrderController::class, 'open']);
        Route::post('/orders/{order}/items', [OrderController::class, 'addItem']);
        Route::post('/orders/{order}/close', [OrderController::class, 'close']);
        Route::get('/restaurant-tables', [RestaurantTableController::class, 'index']);

    });
});
