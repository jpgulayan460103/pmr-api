@ECHO OFF
php artisan migrate:refresh --seed --env=testing
php artisan passport:install --env=testing
redis-cli flushall
PAUSE 