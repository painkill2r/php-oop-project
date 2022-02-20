<?php

namespace App\Providers;

use Painkill2r\InflearnLectureLib\Support\ServiceProvider;
use Painkill2r\InflearnLectureLib\Database\Adaptor;

class DatabaseServiceProvider extends ServiceProvider
{
    public static function register()
    {
        Adaptor::setup("mysql:host=58.151.141.250;port=3306;dbname=oopproject", "oopproject", "oopproject123~");
    }
}
