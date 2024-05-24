<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ApiContext::class, function ($app) {
            $paypalConfig = config('paypal');
            $apiContext = new ApiContext(
                new OAuthTokenCredential(
                    $paypalConfig['sandbox']['client_id'],
                    $paypalConfig['sandbox']['secret']
                )
            );

            $apiContext->setConfig($paypalConfig['settings']);
            return $apiContext;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
