<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Facebook\Facebook;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Facebook::class, function ($app) {
            return new Facebook([
                'app_id' => config('app.facebook_app_id'),
                'app_secret' => config('app.facebook_app_secret'),
                'default_graph_version' => 'v14.0',
            ]);
        });
    
        $this->app->singleton(FacebookService::class, function ($app) {
            return new FacebookService($app->make(Facebook::class));
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
