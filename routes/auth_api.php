<?php

use App\Http\Controllers\Api\{FormPaymentApiController, TableApiController};
use App\Http\Controllers\Api\Auth\{ClientController, OrderTenantController, UserApiController};
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->group(
        function () {
            Route::get('tables', [TableApiController::class, 'search']);


            Route::get('/my-orders', [OrderTenantController::class, 'index']);
            Route::post('/orders', [OrderTenantController::class, 'store']);
            Route::patch('/my-orders', [OrderTenantController::class, 'update']);

            Route::get('/products/{flag}', [OrderTenantController::class, 'product']);
            Route::get('/products', [OrderTenantController::class, 'products']);

            Route::get('/clients', [ClientController::class, 'search']);
            Route::post('/clients', [ClientController::class, 'store']);

            Route::get('/users/deliverymen', [UserApiController::class, 'deliverymen']);

            // Form Payments
            Route::get('form-payments/{FormPayment}', [FormPaymentApiController::class, 'show']);
            Route::put('form-payments/{FormPayment}', [FormPaymentApiController::class, 'update']);
            Route::get('form-payments', [FormPaymentApiController::class, 'index']);
            Route::post('form-payments', [FormPaymentApiController::class, 'store']);
            Route::delete('form-payments/{flagFormPayment}', [FormPaymentApiController::class, 'destroy']);
        }
    );
