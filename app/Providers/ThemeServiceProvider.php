<?php

namespace App\Providers;

use Painkill2r\InflearnLectureLib\Support\ServiceProvider;
use Painkill2r\InflearnLectureLib\Support\Theme;

class ThemeServiceProvider extends ServiceProvider
{
    public static function register()
    {
        Theme::setLayout(dirname(__DIR__, 2) . "/resources/views/layouts/app.php");
    }
}