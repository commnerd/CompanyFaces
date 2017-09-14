#!/bin/bash

cd $(dirname $0)/..

composer install
npm install
cp deploy/env.example ./.env
php artisan key:generate
php artisan storage:link
touch database/database.sqlite
php artisan migrate:fresh --seed
npm run dev
