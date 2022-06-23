cls

@echo off

@echo Make sure the database has been created

pause

echo init start...

echo 1. copy env file

copy .env.example .env

echo.

echo 2. install packages

call composer install

echo.

echo 3. generate project keys

php artisan key:generate

echo.

echo 4. create storage link

php artisan storage:link

echo.

echo 5. admin publish

php artisan admin:publish

echo.

echo 6. admin install

php artisan admin:install

echo.

echo 7. migrate database

php artisan db:seed --class=MenuSeeder

echo.

echo done.
