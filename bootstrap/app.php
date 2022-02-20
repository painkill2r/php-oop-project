<?php

use Painkill2r\InflearnLectureLib\Application;

$app = new Application([
    \App\Providers\ErrorServiceProvider::class,
    \App\Providers\DatabaseServiceProvider::class,
    \App\Providers\SessionServiceProvider::class,
    \App\Providers\ThemeServiceProvider::class,
    \App\Providers\RouteServiceProvider::class
]);

return $app;

