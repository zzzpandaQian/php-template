#!/bin/bash
set -e

echo "Make sure the database has been created"

read -s -n1 -p "Press any key to continue ... "

echo "init start..."

echo "1. copy env file"

cp .env.example .env

echo "2. install packages"

composer install

echo "3. generate project keys"

php artisan key:generate

echo "4. migrate database"

# php artisan migrate --seed
# php artisan db:seed --class=MenuSeeder

echo "5. create storage link"

php artisan storage:link

echo "6. admin publish"

php artisan admin:publish

echo "7. admin install"

# php artisan admin:install

echo "done."
