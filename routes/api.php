<?php

use Painkill2r\InflearnLectureLib\Routing\Route;
use App\Middlewares\AuthMiddleware;

Route::add("post", "/images", "\App\Controllers\ImageController::store", [AuthMiddleware::class]);
Route::add("get", "/images/{path}", "\App\Controllers\ImageController::show");