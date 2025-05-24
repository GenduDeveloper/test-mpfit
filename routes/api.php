<?php

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

});
