<?php

namespace App\Controllers;

use App\Services\ImageService;

class ImageController
{
    /**
     * @var array $accepts 업로드 가능한 파일 확장자 목록
     */
    private static $accepts = ['png', 'jpeg', 'jpg'];

    /**
     * @var string $uploadDirectory 파일 업로드 경로
     */
    private static $uploadDirectory = __DIR__ . "/../../storage/app/images/";

    /**
     * 파일 저장 메소드
     *
     * @return void
     */
    public static function store()
    {
        if (array_key_exists("upload", $_FILES)) {
            $file = $_FILES['upload'];
            $filename = $_SESSION['user']->id . "_" . time() . "_" . hash('md5', $file['name']);

            echo ImageService::create($file, self::$accepts, self::$uploadDirectory . $filename);

            return;
        }

        return http_response_code(404);
    }

    /**
     * 파일 출력 메소드
     *
     * @param string $path 파일명
     * @return void
     */
    public static function show($path)
    {
        if (preg_match("/\d_\d{10}_[0-9a-z]{32}/", $path)) {
            echo ImageService::read(self::$uploadDirectory . basename($path));

            return;
        }

        return http_response_code(404);
    }
}
