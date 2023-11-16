```
cd laravel-delivery-test-laravel-comments
composer install
cp .env.example .env 
./vendor/bin/sail up   
php artisan sail:install

docker ps
docker exec -it [container-id] /bin/bash

php artisan migrate
php artisan key:generate

https://localhost:80
 ```
