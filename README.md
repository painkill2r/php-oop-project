# My PHP Proeject

#### 등록일: 2022.02.20(일)

## 개발 환경

1. OS
    - MacOS Monterey 12.2
2. Language
    - PHP 8.0.0
3. Databse
    - Maria DB 10.4.17

## Directory 구조

```bash
├── .gitignore
├── README.md
├── composer.json
├── composer.lock
├── app
│   ├── Controllers
│   │   ├── AuthController.php
│   │   ├── ImageController.php
│   │   ├── IndexController.php
│   │   ├── PostController.php
│   │   └── UserController.php
│   ├── Middlewares
│   │   ├── AuthMiddleware.php
│   │   ├── CsrfTokenMiddleware.php
│   │   └── RequireMiddleware.php
│   ├── Post.php
│   ├── Providers
│   │   ├── DatabaseServiceProvider.php
│   │   ├── ErrorServiceProvider.php
│   │   ├── RouteServiceProvider.php
│   │   ├── SessionServiceProvider.php
│   │   └── ThemeServiceProvider.php
│   ├── Services
│   │   ├── AuthService.php
│   │   ├── ImageService.php
│   │   ├── IndexService.php
│   │   ├── PostService.php
│   │   └── UserService.php
│   └── User.php
├── bootstrap
│   └── app.php
├── public
│   ├── app.css
│   ├── app.js
│   └── index.php
├── resources
│   └── views
│       ├── auth.php
│       ├── index.php
│       ├── layouts
│       │   └── app.php
│       ├── post.php
│       └── read.php
├── routes
│   ├── api.php
│   └── web.php
├── storage
    ├── app
    │   └── images
    ├── logs
    └── sessions
```

### 프로그램 실행 방법

1. PHP 내장서버 사용
    - Terminal에서 프로젝트 디렉토리로 이동 후 아래 명령어를 입력
   ```bash
   # cd {WORKSPACE}
   # php -S localhost:{PORT} -t public
   ```
   
### MariaDB DDL
```mysql
DROP TABLE sessions;
DROP TABLE users;
DROP TABLE posts;
COMMIT;

CREATE TABLE IF NOT EXISTS sessions
(
    id         VARCHAR(255) PRIMARY KEY COMMENT 'Session 아이디',
    payload    TEXT COMMENT 'Session 정보',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시'
    );

CREATE TABLE IF NOT EXISTS users
(
    id         INT AUTO_INCREMENT PRIMARY KEY COMMENT '회원 고유 일련번호',
    email      VARCHAR(255) UNIQUE NOT NULL COMMENT '이메일',
    password   VARCHAR(255)        NOT NULL COMMENT '비밀번호',
    username   VARCHAR(50) COMMENT '이름',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시'
    );

CREATE TABLE IF NOT EXISTS posts
(
    id         INT AUTO_INCREMENT PRIMARY KEY COMMENT '게시글 고유 일련번호',
    user_id    INT DEFAULT NULL COMMENT '회원 고유 일련번호',
    title      VARCHAR(255) NOT NULL COMMENT '제목',
    content    TEXT COMMENT '내용',
    created_at TIMESTAMP DEFAULT CURRENT_TIME COMMENT '등록일시',
    updated_at TIMESTAMP DEFAULT CURRENT_TIME ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시',
    CONSTRAINT posts_fk1_user_id FOREIGN KEY (user_id) REFERENCES users (id)
    );

COMMIT;
```