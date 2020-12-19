<?php

namespace App\Providers;

// Contracts
use Illuminate\Support\ServiceProvider;

use App\Contracts\PaymentGatewayContract;

use App\Services\FlutterwaveService;


class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [
        PaymentGatewayContract::class => FlutterwaveService::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
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
