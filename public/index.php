<?php
use \Firebase\JWT\JWT;

require '../vendor/autoload.php';
require '../config.php';
require '../app/Estado.php';
require '../app/Cidade.php';

$app = new \Slim\App;

$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path" => "/api",
    "secret" => "secretpassword"
]));

$app->get('/token', function (){
    $token = array (
        'name' => 'user'
    );

    $jwt = JWT::encode($token, "secretpassword");

    return $jwt;
});

//Rotas Estado
$app->get('/api/estados', \Estado::class . ':listEstados');

$app->post('/api/estados', \Estado::class . ':addEstado');

$app->get('/api/estados/{id}', \Estado::class . ':showEstado');

$app->put('/api/estados/{id}', \Estado::class . ':editEstado');

$app->delete('/api/estados/{id}', \Estado::class . ':deleteEstado');

//Rotas Cidade
$app->get('/api/cidades', \Cidade::class . ':listCidades');

$app->post('/api/cidades', \Cidade::class . ':addCidade');

$app->get('/api/cidades/{id}', \Cidade::class . ':showCidade');

$app->put('/api/cidades/{id}', \Cidade::class . ':editCidade');

$app->delete('/api/cidades/{id}', \Cidade::class . ':deleteCidade');

$app->run();