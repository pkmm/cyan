#!/usr/bin/env bash

# 同步代码
git pull

# update composer 
composer self-update
composer install
composer dump-autoload

#设置目录的权限
# 第一次要设置
#chmod -R 777 storage/
#chmod -R 777 bootstrap/



php artisan clear-compiled

# 缓存配置文件
php artisan config:clear
php artisan route:clear

php artisan migrate
php artisan optimize


php artisan route:cache
php artisan config:cache


#重新启动队列监听器
supervisorctl restart cyan-worker:*
# 重新启动swoole http 代理 需自己配好supervisor
supervisorctl restart laravel_swoole_http
