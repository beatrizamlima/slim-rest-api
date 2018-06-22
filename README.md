# Slim Rest API
Simple API that perform cities and states CRUD.

### How to use
- Clone the repository
- Install the dependencies
```php
composer install
```
- Configure your mongo host/database inside *config.php*
- Go to */public* and start the server
```php
php -S localhost:8000
```

### Technologies used
- PHP 7.1
- MongoDB
- Slim Framework
- FireBase JWT

### Dependencies
- slim/slim
- mongodb/mongodb
- tuupola/slim-jwt-auth
- firebase/php-jwt
- tuupola/base62
- tuupola/slim-basic-auth
- tuupola/cors-middleware
