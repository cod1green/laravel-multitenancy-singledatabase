<?php

use App\Http\Controllers\Api\{CategoryApiController,
    ContactController,
    CouponApiController,
    EvaluationApiController,
    FormPaymentApiController,
    OrderApiController,
    ProductApiController,
    ProviderApiController,
    TableApiController,
    TenantApiController
};
use App\Http\Controllers\Api\Auth\{AuthClientController, ClientController};
use Illuminate\Support\Facades\Route;

Route::post('/auth/clients', [ClientController::class, 'store']);
Route::post('/auth/token', [AuthClientController::class, 'auth']);

Route::post('/contact', [ContactController::class, 'sendContact']);

Route::middleware('auth:sanctum')
    ->group(
        function () {
            Route::post('/auth/clients/logout', [AuthClientController::class, 'logout']);
            Route::get('/auth/clients/me', [AuthClientController::class, 'me']);

            Route::post('/auth/tenants/{uuid}/orders', [OrderApiController::class, 'store']);
        }
    );

Route::prefix('v1')
    ->group(
        function () {
            Route::middleware('auth:sanctum')
                ->group(
                    function () {
                        Route::post('orders/{identify}/evaluations', [EvaluationApiController::class, 'store']);

                        Route::get('clients/my-orders', [OrderApiController::class, 'myOrders']);

                        Route::get(
                            'tenants/{flagTenant}/form-payments/{FormPayment}',
                            [FormPaymentApiController::class, 'show']
                        );
                        Route::put(
                            'tenants/{flagTenant}/form-payments/{FormPayment}',
                            [FormPaymentApiController::class, 'update']
                        );
                        Route::get('tenants/{flagTenant}/form-payments', [FormPaymentApiController::class, 'index']);
                        Route::post('tenants/{flagTenant}/form-payments', [FormPaymentApiController::class, 'store']);
                        Route::delete(
                            'tenants/{flagTenant}/form-payments/{flagFormPayment}',
                            [FormPaymentApiController::class, 'destroy']
                        );
                    }
                );

            // Providers
            Route::get('tenants/{flagTenant}/providers/{flagProvider}', [ProviderApiController::class, 'show']);
            Route::put('tenants/{flagTenant}/providers/{flagProvider}', [ProviderApiController::class, 'update']);
            Route::get('tenants/{flagTenant}/providers', [ProviderApiController::class, 'index']);
            Route::post('tenants/{flagTenant}/providers', [ProviderApiController::class, 'store']);
            Route::delete('tenants/{flagTenant}/providers/{flagProvider}', [ProviderApiController::class, 'destroy']);

            //Coupon
            Route::get('tenants/{flagTenant}/verify/{coupon}', [CouponApiController::class, 'verify']);
            Route::get('tenants/{flagTenant}/coupons/{flagCoupon}', [CouponApiController::class, 'show']);
            Route::put('tenants/{flagTenant}/coupons/{flagCoupon}', [CouponApiController::class, 'update']);
            Route::get('tenants/{flagTenant}/coupons', [CouponApiController::class, 'index']);
            Route::post('tenants/{flagTenant}/coupons', [CouponApiController::class, 'store']);
            Route::delete('tenants/{flagTenant}/coupons/{flagCoupon}', [CouponApiController::class, 'destroy']);

            // Tenants
            Route::get('tenants/{uuid}', [TenantApiController::class, 'show']);
            Route::get('tenants', [TenantApiController::class, 'index']);

            Route::get('tenants/{uuid}/categories/{flag}', [CategoryApiController::class, 'categoryByTenant']);
            Route::get('tenants/{uuid}/categories', [CategoryApiController::class, 'categoriesByTenant']);

            Route::get('tenants/{uuid}/tables/{identify}', [TableApiController::class, 'tableByTenant']);
            Route::get('tenants/{uuid}/tables', [TableApiController::class, 'tablesByTenant']);

            Route::get('tenants/{uuid}/products/{flag}', [ProductApiController::class, 'productByFlag']);
            Route::get('tenants/{uuid}/products', [ProductApiController::class, 'productsByTenant']);

            Route::get('orders/{identify}', [OrderApiController::class, 'show']);
            Route::post('tenants/{uuid}/orders', [OrderApiController::class, 'store']);
        }
    );

Route::fallback(
    function () {
        return response()->json(
            [
                'message' => __('Page not found. If the error persists, contact') . ' ' . config('admin.admin_email')
            ],
            404
        );
    }
);
