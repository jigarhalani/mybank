<?php

namespace App\Providers;


use App\Repositories\Account\AccountInterface;
use App\Repositories\Account\AccountRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
	    Schema::defaultStringLength(191);
	    $this->app->bind( AccountInterface::class, AccountRepository::class );
    }
}
