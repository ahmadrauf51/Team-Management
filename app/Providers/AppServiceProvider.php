<?php

namespace App\Providers;

use App\Services\MockTaskProvider1;
use App\Services\MockTaskProvider2;
use App\Services\TaskAllocator;
use App\Services\TaskProviderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MockTaskProvider1::class, function ($app) {
            return new MockTaskProvider1();
        });

        $this->app->bind(MockTaskProvider2::class, function ($app) {
            return new MockTaskProvider2();
        });

        $this->app->bind(TaskAllocator::class, function ($app) {
            return new TaskAllocator();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
