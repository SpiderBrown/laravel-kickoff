<?php

namespace App;
//for AdminLTE Menu
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust;

class MenuGateFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['can']) && ! Laratrust::can($item['can'])) {
            return false;
        }
        return $item;
    }

}