<?php

namespace App\Providers;

use App\Repository\CommentRepo;
use App\Repository\TagRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(CommentRepo::class);
        $this->app->bind(TagRepo::class);

    }
}
