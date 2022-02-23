<?php

namespace App\Controllers;

use App\Post;
use App\Services\PostService;
use Painkill2r\InflearnLectureLib\Support\Theme;

class PostController
{
    /**
     * 글 작성 페이지 호출 메소드
     *
     * @return mixed
     */
    public static function create()
    {
        return Theme::view("post", [
            "requestUrl" => "/posts"
        ]);
    }

    /**
     * 글 등록 메소드
     *
     * @return void
     */
    public static function store()
    {
        $post = new Post();
        $post->title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $post->content = filter_input(INPUT_POST, "content");
        $post->user_id = $_SESSION['user']->id;

        return PostService::write($post)
            ? header("Location: /")
            : header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    /**
     * 글 보기 페이지 호출 메소드
     *
     * @param string $id 글 고유 번호
     * @return bool|int|mixed
     */
    public static function show($id)
    {
        if ($post = Post::get($id)) {
            return Theme::view("read", compact("post"));
        }

        return http_response_code(404);
    }

    /**
     * 글 수정 페이지 호출 메소드
     *
     * @param string $id 글 고유 번호
     * @return bool|int
     */
    public static function edit($id)
    {
        if ($post = Post::get($id)) {
            return $post->isOwner() && Theme::view("post", [
                    "post" => $post,
                    "requestUrl" => "/posts/" . $post->id,
                    "method" => "patch"
                ]);
        }

        return http_response_code(404);
    }

    /**
     * 글 수정 메소드
     *
     * @param string $id 글 고유 번호
     * @return bool|int|void
     */
    public static function update($id)
    {
        if ($post = Post::get($id)) {
            //Route는 PATCH, 실제로는 POST로 요청이 들어오게 됨.
            $post->title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $post->content = filter_input(INPUT_POST, "content");

            return ($post->isOwner() && PostService::update($post))
                ? header("Location: /posts/" . $post->id)
                : header("Location: " . $_SERVER['HTTP_REFERER']);
        }

        return http_response_code(404);
    }

    /**
     * 글 삭제 메소드
     *
     * @param string $id 글 고유 번호
     * @return bool|int
     */
    public static function destroy($id)
    {
        if ($post = Post::get($id)) {
            if ($post->isOwner() && PostService::delete($post)) {
                return http_response_code(204);
            }
        }

        return http_response_code(404);
    }
}
