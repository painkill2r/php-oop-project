<?php

namespace App\Services;

use Painkill2r\InflearnLectureLib\Database\Adaptor;

class IndexService
{
    /**
     * 게시글 목록 조회 메소드
     *
     * @param $page
     * @param $count
     * @return void
     */
    public static function getPosts($page, $count)
    {
        return Adaptor::getAll("SELECT * FROM posts ORDER BY id DESC LIMIT " . $count . " OFFSET " . $page * $count, [], \App\Post::class);
    }
}
