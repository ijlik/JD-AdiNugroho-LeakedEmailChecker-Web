<?php

namespace App\Providers;

use App\Services\EmailBreachService;
use Illuminate\Support\ServiceProvider;

class EmailBreachServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(EmailBreachService::class, function ($app) {
            return new EmailBreachService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
