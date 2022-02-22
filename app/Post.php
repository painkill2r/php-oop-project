<?php

namespace App;

use Painkill2r\InflearnLectureLib\Database\Adaptor;

class Post
{
    public function user()
    {
        return current(Adaptor::getAll("SELECT * FROM users WHERE id = ?", [$this->user_id], \App\User::class));
    }

    public function getCreatedAt()
    {
        return date("h:i A, M j", strtotime($this->created_at));
    }

    public function getusername()
    {
        return $this->user()->getUsername();
    }

    public function getSummary()
    {
        return filter_var(mb_substr(strip_tags($this->content), 0, 200), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
}