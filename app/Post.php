<?php

namespace App;

use Painkill2r\InflearnLectureLib\Database\Adaptor;

class Post
{
    /**
     * 글 작성 메소드
     *
     * @return void
     */
    public function create()
    {
        return Adaptor::exec(
            "INSERT INTO posts (user_id, title, content) VALUE (?, ?, ?)",
            [$this->user_id, $this->title, $this->content]
        );
    }

    /**
     * 글 수정 메소드
     *
     * @return void
     */
    public function update()
    {
        return Adaptor::exec(
            "UPDATE posts SET title = ?, content = ? WHERE id = ?",
            [$this->title, $this->content, $this->id]
        );
    }

    /**
     * 글 삭제 메소드
     *
     * @return void
     */
    public function delete()
    {
        return Adaptor::exec(
            "DELETE FROM posts WHERE id = ?",
            [$this->id]
        );
    }

    /**
     * 글 작성한 유저 정보 조회 메소드
     *
     * @return false|mixed
     */
    public function user()
    {
        return current(Adaptor::getAll("SELECT * FROM users WHERE id = ?", [$this->user_id], \App\User::class));
    }

    public function isOwner()
    {
        if (array_key_exists("user", $_SESSION)) {
            return $this->user_id == $_SESSION['user']->id;
        }

        return false;
    }

    /**
     * 글 작성 일시 조회 메소드
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return date("h:i A, M j", strtotime($this->created_at));
    }

    /**
     * 글 작성한 유저 이름 조회 메소드
     *
     * @return mixed
     */
    public function getusername()
    {
        return $this->user()->getUsername();
    }

    /**
     * 글 내용 파싱(Parsing) 메소드
     *
     * @return mixed
     */
    public function getSummary()
    {
        return filter_var(mb_substr(strip_tags($this->content), 0, 200), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    public static function get($id)
    {
        return current(Adaptor::getAll("SELECT * FROM posts WHERE id = ?", [$id], \App\Post::class));
    }
}