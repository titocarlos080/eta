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
    public function boot(Dispatcher  $events)
    {
        Paginator::useBootstrap();

        $events->list(BuildingMenu::class, function (BuildingMenu $event) {
            $items = Menu::where('actived', true)->get()->map(function ($menu) {
                return [
                    "key" => 'menu' . $menu->id,
                    'text' => $menu->description,
                    'route' => [$menu->route, ['id' => $menu->id]],
                    'active' => ['menu/' . $menu->id . '/*'],
                    'icon' => $menu->icon,
                ];
            });

            $event->menu->addIn('dynamic_menus', ...$items);
        });
    }
}
