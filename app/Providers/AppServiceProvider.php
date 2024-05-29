<?php

namespace App\Providers;

use App\Repositories\CommentRepository;
use App\Repositories\HistoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HistoryRepository::class, function ($app) {
            return new HistoryRepository();
        });

        $this->app->bind(CommentRepository::class, function ($app) {
            return new CommentRepository();
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
