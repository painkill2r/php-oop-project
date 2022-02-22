<?php

namespace App;

use Painkill2r\InflearnLectureLib\Database\Adaptor;

class User
{
    public function create()
    {
        return Adaptor::exec("INSERT INTO users (email, password) VALUES (?, ?)", [$this->email, $this->password]);
    }

    public function getUsername()
    {
        return current(explode('@', $this->email));
    }
}