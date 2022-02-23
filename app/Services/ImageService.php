<?php

namespace App\Services;

class ImageService
{
    /**
     * 파일 저장 메소드
     *
     * @param object $file 파일 정보
     * @param $accepts 업로드 가능한 파일 확장자 목록
     * @param $filename 파일 업로드 경로
     * @return void
     */
    public static function create($file, $accepts, $filename)
    {
        $fileinfo = new \SplFileInfo($file['name']);

        if (in_array(strtolower($fileinfo->getExtension()), $accepts) && is_uploaded_file($file['tmp_name'])) {
            if (move_uploaded_file($file['tmp_name'], $filename)) {
                return json_encode([
                    "uploaded" => 1,
                    "url" => "/images/" . basename($filename)
                ]);
            }
        }

        return false;
    }

    /**
     * 파일 출력 메소드
     *
     * @param $path 파일 경로
     * @return bool|int
     */
    public static function read($path)
    {
        if (file_exists($path)) {
            header("Content-Type: " . mime_content_type($path));

            return file_get_contents($path);
        }

        return http_response_code(404);
    }
}