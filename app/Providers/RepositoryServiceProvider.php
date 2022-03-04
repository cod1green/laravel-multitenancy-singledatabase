<?php

namespace App\Providers;

use App\Repositories\Contracts\{CategoryRepository,
    CouponRepository,
    EvaluationRepository,
    FormPaymentRepository,
    OrderRepository,
    ProductRepository,
    ProviderRepository,
    TableRepository,
    TenantRepository,
    UserRepository
};
use App\Repositories\Eloquent\{EloquentCategoryRepository,
    EloquentCouponRepository,
    EloquentEvaluationRepository,
    EloquentFormPaymentRepository,
    EloquentOrderRepository,
    EloquentProductRepository,
    EloquentProviderRepository,
    EloquentTableRepository,
    EloquentTenantRepository,
    EloquentUserRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepository::class,
            EloquentTenantRepository::class,
        );

        $this->app->bind(
            CategoryRepository::class,
            EloquentCategoryRepository::class,
        );

        $this->app->bind(
            TableRepository::class,
            EloquentTableRepository::class,
        );

        $this->app->bind(
            ProductRepository::class,
            EloquentProductRepository::class
        );

        $this->app->bind(
            OrderRepository::class,
            EloquentOrderRepository::class
        );

        $this->app->bind(
            EvaluationRepository::class,
            EloquentEvaluationRepository::class
        );

        $this->app->bind(
            CouponRepository::class,
            EloquentCouponRepository::class
        );

        $this->app->bind(
            ProviderRepository::class,
            EloquentProviderRepository::class
        );

        $this->app->bind(
            FormPaymentRepository::class,
            EloquentFormPaymentRepository::class
        );

        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
