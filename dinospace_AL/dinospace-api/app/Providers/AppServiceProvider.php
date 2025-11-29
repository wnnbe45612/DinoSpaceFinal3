<?php

namespace App\Providers;

use App\Services\ChatService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // // Registramos ChatService como singleton: Laravel usa la misma instancia siempre.
        $this->app->singleton(ChatService::class, function ($app) {
            return new ChatService();
        });
    }
}