<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

require '../vendor/autoload.php';
require '../config.php';
require '../app/Estado.php';
require '../app/Cidade.php';

//Define aplicação
$app = new \Slim\App;

//Define tipo do header
$app->add(function(Request $request, Response $response, $next) {
    $response = $next($request, $response);
    return $response->withHeader('Content-Type', 'application/json');
});

//Adiciona middleware do JWT para validar a permissão de rotas
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path" => "/api",
    "secret" => "secretpassword"
]));

//Função para gerar token (válida apenas para testar funcionamento do middleware do JWT)
$app->get('/token', function (){
    $token = array (
        'name' => 'user'
    );

    $jwt = JWT::encode($token, "secretpassword");

    return $jwt;
});

//Rotas Estado
//Lista todos os estados e permite filtro por query string
$app->get('/api/estados', \Estado::class . ':listEstados');
//Adiciona um novo estado
$app->post('/api/estados', \Estado::class . ':addEstado');
//Mostra um estado baseado na id
$app->get('/api/estados/{id}', \Estado::class . ':showEstado');
//Edita um estado
$app->put('/api/estados/{id}', \Estado::class . ':editEstado');
//Deleta um estado
$app->delete('/api/estados/{id}', \Estado::class . ':deleteEstado');

//Rotas Cidade
//Lista todas as cidades e permite filtro por query string
$app->get('/api/cidades', \Cidade::class . ':listCidades');
//Adiciona uma nova cidade
$app->post('/api/cidades', \Cidade::class . ':addCidade');
//Mostra uma cidade baseado na id
$app->get('/api/cidades/{id}', \Cidade::class . ':showCidade');
//Edita uma cidade
$app->put('/api/cidades/{id}', \Cidade::class . ':editCidade');
//Deleta uma cidade
$app->delete('/api/cidades/{id}', \Cidade::class . ':deleteCidade');

//Inicia aplicação
$app->run();