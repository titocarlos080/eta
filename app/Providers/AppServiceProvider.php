<?php

namespace App\Providers;

use App\Models\Menu;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Pagination\Paginator;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;

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
    public function boot( )
    {
         
    }
}
