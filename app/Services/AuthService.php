<?php

namespace App\Services;

use Painkill2r\InflearnLectureLib\Database\Adaptor;

class AuthService
{

    public static function login($email, $password)
    {
        if ($user = current(Adaptor::getAll("SELECT * FROM users WHERE email = ?", [$email], \App\User::class))) {
            if (\password_verify($password, $user->password)) {
                return $_SERVER['user'] = $user;
            }
        }
    }

    public static function logout()
    {
        session_unset();

        return session_destroy();
    }
}