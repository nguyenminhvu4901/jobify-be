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
1. sh
```sh
git clone https://github.com/Laradock/laradock.git
cd laradock
cp .env.example .env
```
2. sh .env in laradock
```sh .env in laradock
APP_CODE_PATH_HOST=../jobify-be
COMPOSE_PROJECT_NAME=jobify

PHP_VERSION=8.3

WORKSPACE_INSTALL_NODE=true
WORKSPACE_INSTALL_YARN=true
PHP_FPM_INSTALL_PHPREDIS=true
WORKSPACE_INSTALL_MONGO=true
PHP_FPM_INSTALL_MYSQLI=true
PHP_FPM_INSTALL_MONGO=true

NGINX_HOST_HTTP_PORT=80
NGINX_HOST_HTTPS_PORT=443
NGINX_HOST_LOG_PATH=./logs/nginx/
NGINX_SITES_PATH=./nginx/sites/
NGINX_PHP_UPSTREAM_CONTAINER=php-fpm
NGINX_PHP_UPSTREAM_PORT=9000
NGINX_SSL_PATH=./nginx/ssl/

MYSQL_VERSION=latest
MYSQL_DATABASE=default
MYSQL_USER=default
MYSQL_PASSWORD=secret
MYSQL_PORT=3306
MYSQL_ROOT_PASSWORD=root

REDIS_PORT=6379
REDIS_PASSWORD=secret_redis

MONGODB_PORT=27017
MONGO_USERNAME=root
MONGO_PASSWORD=example

ELASTICSEARCH_HOST_HTTP_PORT=9200
ELASTICSEARCH_HOST_TRANSPORT_PORT=9300

KIBANA_HTTP_PORT=5601

ELK_VERSION=7.17.0
```

3. sh .env in php8.3.ini in php-fpm:
```sh .env in php8.3.ini in php-fpm
post_max_size = 500M
upload_max_filesize = 500M
memory_limit = 512M
max_input_time = 300
max_execution_time = 300
max_input_vars = 3000
```

4. mysql/my.cnf
```
# The MySQL  Client configuration file.
#
# For explanations see
# http://dev.mysql.com/doc/mysql/en/server-system-variables.html

[mysql]
mysql_native_password=on
[mysqld]
sql-mode="STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION"
character-set-server=utf8
innodb_use_native_aio=0
```

5. mysql/Dockerfile
```
ARG MYSQL_VERSION
FROM mysql:${MYSQL_VERSION}

#####################################
# Set Timezone
#####################################

ARG TZ=UTC
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && chown -R mysql:root /var/lib/mysql/

COPY my.cnf /etc/mysql/conf.d/my.cnf

RUN chmod 0444 /etc/mysql/conf.d/my.cnf

RUN if [ ${MYSQL_MAJOR} = '8.0' ]; then \
    echo 'default-authentication-plugin=mysql_native_password' >> /etc/mysql/conf.d/my.cnf; \
  fi

```

### 2. Source code:
1. Clone code:
```sh
git clone [https://github.com/nguyenminhvu4901/DoAnTotNghiep](https://github.com/nguyenminhvu4901/jobify-be.git)
cd jobify-be
cp .env.example .env
```

2. Run docker:
```sh
cd laradock
docker compose up -d mysql nginx phpmyadmin workspace redis mongo elasticsearch kibana
```

3. Open workspace:
```sh
docker-compose exec workspace bash
```

4. Build vendor
```sh
pecl install mongodb
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate --seed
phpunit
composer dump-autoload
php artisan storage:link
php artisan l5-swagger:generate
php artisan scout:import "App\Entities\JobSeries\JobListing\JobListing" -v
```

5. Build and install supervisor (For macos)

* Install supervisor into workspace bash (macos)
```
cd /
apt update
apt install supervisor
supervisord --version
nano /etc/supervisor/conf.d/laravel-worker.conf (File để chạy supervisor, có thể không tạo vì dự án đã có sẵn rồi)
cấu hình file nếu muốn tạo
```
* File supervisor example 
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/storage/logs/worker.log
stderr_logfile=/var/www/storage/logs/worker-error.log
stopwaitsecs=3600
```
* Config and start supervisor
```
tiếp tục thoát file và chạy các câu lệnh 
cd /etc/supervisor

truy cập vào file cấu hình của supervisor
nano supervisord.conf

thêm path file conf để chạy tiến trình, ở cuối file có [include]
thêm dường dẫn đến file conf
ví dụ:
[include]
files = /etc/supervisor/conf.d/*.conf /var/www/laravel-worker.conf /var/www/laravel-schedule.conf /var/www/laravel-horizon.conf

tiếp tục chạy các câu lệnh
supervisord -c /etc/supervisor/supervisord.conf
supervisorctl reread
supervisorctl update
supervisorctl start all
supervisorctl status
```

### 3. Notice
```
Mỗi khi chạy seed sẽ chạy hết các lệnh seed đã lưu ở trên
```
### 4. Error
```
Nếu code có vấn đề, hãy chạy các câu lệnh terminal sau:
composer install
composer update
npm install
php artisan cache:clear
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan config:cache
```

### 5. Performance Dashboard Package
1. laravel/horizon
```
http://localhost/horizon
Giao diện quản lý queue Redis, xem job, retry, failed job, metrics.
```
2. laravel/telescope
```
http://localhost/telescope/requests
Giao diện debug toàn hệ thống: request, query, log, event, job...
```
3. laravel/pulse
```
http://localhost/pulse
Giao diện thống kê hiệu suất (CPU, memory, queries...)
```
4. darkaonline/l5-swagger
```
http://localhost/api/documentation
Swagger UI – tài liệu API tự động
```
5. elasticsearch
```
http://localhost:9200/
Elasticsearch
```
6. kibana
```
http://localhost:5601/app/home#/
Giao diện Kibana dùng để hiển thị Elasticsearch
```


