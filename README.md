<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Environmental Construction Guide

## Link thiết kế DB: [jobify](https://app.diagrams.net/#G1MHKHAJCcUZsuLNTaZRe6iku1Q8seKtCC#%7B%22pageId%22%3A%22R6fDEAyaQSlj4W-26p9j%22%7D)

### Installation
Put laradock and source code directories like below:
```sh
- projects
    -- laradock
    -- jobify-be
```
### 1. Laradock
```sh
git clone https://github.com/Laradock/laradock.git
cd laradock
cp env-example .env
```

```sh .env in laradock
PHP_VERSION=8.3
APP_CODE_PATH_HOST=../jobify-be
COMPOSE_PROJECT_NAME=Jobify
WORKSPACE_INSTALL_NODE=true
WORKSPACE_INSTALL_YARN=true

PHP_FPM_INSTALL_MYSQLI=true

MYSQL_VERSION=latest
MYSQL_DATABASE=default
MYSQL_USER=default
MYSQL_PASSWORD=secret
```

```sh .env in php8.3.ini in php-fpm
post_max_size = 500M
upload_max_filesize = 500M
memory_limit = 512M
max_input_time = 300
max_execution_time = 300
max_input_vars = 3000
```

### 2. Source code:
Clone code:
```sh
git clone [https://github.com/nguyenminhvu4901/DoAnTotNghiep](https://github.com/nguyenminhvu4901/jobify-be.git)
cd jobify-be
cp .env.example .env
```

Run docker:
```sh
cd laradock
docker compose up -d mysql nginx phpmyadmin workspace
```

Open workspace:
```sh
docker-compose exec workspace bash
```

Build vendor
```sh
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate --seed
phpunit
composer dump-autoload
php artisan storage:link
php artisan l5-swagger:generate
```
Notice
```
Mỗi khi chạy seed sẽ chạy hết các lệnh seed đã lưu ở trên
```
Error
```
Nếu code có vấn đề, hãy chạy các câu lệnh terminal sau:
composer install
composer update
php artisan cache:clear
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan config:cache
