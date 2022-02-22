<?php

namespace App\Controllers;

use Painkill2r\InflearnLectureLib\Support\Theme;
use App\Services\IndexService;

class IndexController
{
    public static function index()
    {
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 0;

        return Theme::view("index", [
            "posts" => IndexService::getPosts($page, 3)
        ]);
    }
}
