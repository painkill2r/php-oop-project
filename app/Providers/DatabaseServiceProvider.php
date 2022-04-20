<?php

namespace App\Providers;

use Painkill2r\InflearnLectureLib\Support\ServiceProvider;
use Painkill2r\InflearnLectureLib\Database\Adaptor;

class DatabaseServiceProvider extends ServiceProvider
{
    public static function register()
    {
        Adaptor::setup("mysql:host=127.0.0.1;port=3306;dbname=phpblog", "phpblog", "phpblog");
    }
}
