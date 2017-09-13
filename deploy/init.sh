#!/bin/bash

cd $(dirname $(readlink -f $0))
cd ..

composer install
npm install
cp deploy/env.example ./.env
php artisan key:generate
php artisan storage:link
touch database/database.sqlite
php artisan migrate:fresh --seed
