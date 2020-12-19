<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;
use App\User;
use App\Observers\UserTableObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // when in production or staging, force https so asset files are loaded properly
        if (config('app.env') !== 'local')
        {
            URL::forceScheme('https');
        }

        User::observe(UserTableObserver::class);
        Builder::defaultStringLength(191); // Update defaultStringLength
    }
}
