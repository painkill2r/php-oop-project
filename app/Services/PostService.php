<?php

namespace App\Services;

use App\Post;

class PostService
{
    /**
     * 글 등록
     *
     * @param object $post 글 객체
     * @return mixed
     */
    public static function write($post)
    {
        return $post->create();
    }

    /**
     * 글 수정
     *
     * @param object $post 글 객체
     * @return mixed
     */
    public static function update($post)
    {
        return $post->update();
    }

    /**
     * 글 삭제
     *
     * @param object $post 글 객체
     * @return mixed
     */
    public static function delete($post)
    {
        return $post->delete();
    }
}