# Slim Rest API
Simple API that perform cities and states CRUD.

## How to use
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

## App Directory

```
- app # store object classes
  - Cidade.php # city class with CRUD functions
  - Estado.php # state class with CRUD functions
- public # app main folder
  - index.php # define middlewares, routes and start app
- vendor # dependencies folder
- .gitignore # ignore folders/files on git
- composer.json # project dependencies to install
- composer.lock # dependencies versions that are installed
- config.php # database configuration
```

## Routes

### JWT

#### - Token
 Generate JWT token to use in auth
 - URL
 ```
 /token
 ```
 - Method
  ```
  GET
  ```
 - URL Params
  ```
  none
  ```
 - Data Params
  ```
  none
  ```
### Estados

#### - List
 Returns json with list of states
 - URL
 ```
 /api/estados
 ```
 - Method
  ```
  GET
  ```
 - URL Params
  ```
  none or query string
  Example: ?nome="Rio de janeiro"&abreviacao="RJ"
  ```
 - Data Params
  ```
  none
  ```
#### - Add
 - URL
 ```
 /api/estados
 ```
 - Method
  ```
  POST
  ```
 - URL Params
  ```
  none
  ```
 - Data Params
  ```
  JSON
  ```
#### - Show
 - URL
 ```
 /api/estados/{api}
 ```
 - Method
  ```
  GET
  ```
 - URL Params
  ```
  id = integer
  ```
 - Data Params
  ```
  none
  ```
#### - Edit
 - URL
 ```
 /api/estados/{id}
 ```
 - Method
  ```
  PUT
  ```
 - URL Params
  ```
  id = integer
  ```
 - Data Params
  ```
  JSON
  ```
#### - Delete
 - URL
 ```
 /api/estados/{id}
 ```
 - Method
  ```
  DELETE
  ```
 - URL Params
  ```
  id = integer
  ```
 - Data Params
  ```
  none
  ```

### Cidades

#### - List
 Returns json with list of cities
 - URL
 ```
 /api/cidades
 ```
 - Method
  ```
  GET
  ```
 - URL Params
  ```
  none or query string
  Example: ?nome="Rio de Janeiro"
  ```
 - Data Params
  ```
  none
  ```
#### - Add
 - URL
 ```
 /api/cidades
 ```
 - Method
  ```
  POST
  ```
 - URL Params
  ```
  none
  ```
 - Data Params
  ```
  JSON
  ```
#### - Show
 - URL
 ```
 /api/cidades/{api}
 ```
 - Method
  ```
  GET
  ```
 - URL Params
  ```
  id = integer
  ```
 - Data Params
  ```
  none
  ```
#### - Edit
 - URL
 ```
 /api/cidades/{id}
 ```
 - Method
  ```
  PUT
  ```
 - URL Params
  ```
  id = integer
  ```
 - Data Params
  ```
  JSON
  ```
#### - Delete
 - URL
 ```
 /api/cidades/{id}
 ```
 - Method
  ```
  DELETE
  ```
 - URL Params
  ```
  id = integer
  ```
 - Data Params
  ```
  none
  ```

## Technologies used
- PHP 7.1
- MongoDB
- Slim Framework
- FireBase JWT

## Dependencies
- slim/slim
- mongodb/mongodb
- tuupola/slim-jwt-auth
- firebase/php-jwt
- tuupola/base62
- tuupola/slim-basic-auth
- tuupola/cors-middleware
