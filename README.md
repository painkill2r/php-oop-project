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
2. Apache 웹 서버 사용
    - Version: 2.4.551
    - `Apache 설정(예. httpd.conf)` 또는 `.htaccess` 파일에 아래 설정을 추가
        * 웹 서버에서 라우팅을 동작시킬 때는, 모든 라우트에 대해서 하나의 리퀘스트 경로로 인식하도록 설정해줄 필요가 있음.
        * 아래의 코드는 Laravel 프로젝트에 있는 웹서버 설정, .htaccess 파일을 가져온 것입니다. 모든 요청이 index.php(/) 로 인식해야 라우트가 동작함.
   ```bash
   # ... Apache settings ...
   
   <IfModule mod_rewrite.c>
      <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
      </IfModule>

      RewriteEngine On

      # Handle Authorization Header
      RewriteCond %{HTTP:Authorization} .
      RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

      # Redirect Trailing Slashes If Not A Folder...
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteCond %{REQUEST_URI} (.+)/$
      RewriteRule ^ %1 [L,R=301]

      # Send Requests To Front Controller...
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteRule ^ index.php [L]
   </IfModule>
   
   # ... Apache settings ...
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
    user_id    INT       DEFAULT NULL COMMENT '회원 고유 일련번호',
    title      VARCHAR(255) NOT NULL COMMENT '제목',
    content    TEXT COMMENT '내용',
    created_at TIMESTAMP DEFAULT CURRENT_TIME COMMENT '등록일시',
    updated_at TIMESTAMP DEFAULT CURRENT_TIME ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시',
    CONSTRAINT posts_fk1_user_id FOREIGN KEY (user_id) REFERENCES users (id)
);

COMMIT;
```