<?php

namespace App\Providers;

use Painkill2r\InflearnLectureLib\Support\ServiceProvider;
use Painkill2r\InflearnLectureLib\Routing\Route;

class RouteServiceProvider extends ServiceProvider
{
    public static function register()
    {
        foreach (['web', 'api'] as $name) {
            require_once dirname(__DIR__, 2) . "/routes/" . $name . ".php";
        }
    }

    public static function boot()
    {
        Route::run();
    }
}
