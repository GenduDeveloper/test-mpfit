<?php

use App\Http\Controllers\API\v1\CompleteOrderController;
use App\Http\Controllers\API\v1\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\ProductController;

Route::prefix('/v1')->group(function () {

    Route::controller(ProductController::class)
        ->group(function () {

        Route::get('/products', 'index')
            ->name('products.index');

        Route::get('/products/{productId}', 'show')
            ->name('products.show');

        Route::post('/products', 'store')
            ->name('products.store');

        Route::patch('/products/{productId}', 'update')
            ->name('products.update');

        Route::delete('/products/{productId}', 'destroy')
            ->name('products.destroy');
    });

    Route::controller(OrderController::class)
        ->group(function () {

            Route::get('/orders', 'index')
                ->name('orders.index');

            Route::post('/orders', 'store')
                ->name('orders.store');

            Route::get('/orders/{orderId}', 'show')
                ->name('orders.show');
        });

    Route::put('/orders/{orderId}', CompleteOrderController::class)
        ->name('orders.complete');

});
