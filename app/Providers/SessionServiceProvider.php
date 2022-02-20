<?php

namespace App\Providers;

use Painkill2r\InflearnLectureLib\Support\ServiceProvider;
use Painkill2r\InflearnLectureLib\Session\DatabaseSessionHandler;

class SessionServiceProvider extends ServiceProvider
{
    public static function register()
    {
        session_set_save_handler(new DatabaseSessionHandler());
    }

    public static function boot()
    {
        session_start();
    }
}