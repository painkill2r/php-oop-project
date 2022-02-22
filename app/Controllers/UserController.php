<?php

namespace App\Controllers;

use App\User;
use Painkill2r\InflearnLectureLib\Support\Theme;
use App\Services\UserService;

class UserController
{
    public static function create()
    {
        return Theme::view("auth", [
            "requestUrl" => "/users"
        ]);
    }

    public static function store()
    {
        $user = new User();
        $user->email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
        $user->password = password_hash(filter_input(INPUT_POST, "password"), PASSWORD_DEFAULT);

        return UserService::register($user)
            ? header("Location: /auth/login")
            : header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
