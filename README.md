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
├── README.md
├── composer.json
├── ddl.sql
├── index.php
```

### 파일 설명

1. composer.json
    - Composer 정의 파일
2. ddl.sql
    - 데이터베이스 DDL(Data Definition Language, 데이터 정의어) 파일
3. index.php
    - Main 실행 파일

### 프로그램 실행 방법

1. PHP 내장서버 사용
    - Terminal에서 프로젝트 디렉토리로 이동 후 아래 명령어를 입력
   ```bash
   # cd {WORKSPACE}
   # php -S localhost:{PORT} -t public
   ```