<?php

namespace App\Providers;


use App\Repositories\Account\BuildingInterface;
use App\Repositories\Account\BuildingRepository;

use App\Repositories\Room\RoomInterface;
use App\Repositories\Room\RoomRepository;
use App\Repositories\Tenant\TenantInterface;
use App\Repositories\Tenant\TenantRepository;
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

    }
}
