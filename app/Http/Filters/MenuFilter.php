<?php

namespace App\Http\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['permission']) && ! Laratrust::isAbleTo($item['permission'])) {
            $item['restricted'] = true;
        }

        return $item;
    }
}