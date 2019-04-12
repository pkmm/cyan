#!/usr/bin/env bash

git pull
#composer install
php artisan config:clear
php artisan route:clear

php artisan migrate
php artisan optimize
composer dump-autoload

php artisan route:cache
php artisan config:cache