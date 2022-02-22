<?php

namespace App;

class User
{
    public function getUsername()
    {
        return current(explode('@', $this->email));
    }
}