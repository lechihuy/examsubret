# Requirement
- Apache/Nginx
- MySQL 5.6^
- PHP 7.3^

# After clone repository
- Install JWT

> COMPOSER_MEMORY_LIMIT=-1 composer require tymon/jwt-auth

> php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

> php artisan jwt:secret

- Install 