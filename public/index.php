<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../app/Estado.php';
require '../app/Cidade.php';

$app = new \Slim\App;

$app->get('/estados', \Estado::class . ':listEstados');

$app->post('/estados', \Estado::class . ':addEstado');

$app->get('/estados/{id}', \Estado::class . ':showEstado');

$app->put('/estados/{id}', \Estado::class . ':editEstado');

$app->delete('/estados/{id}', \Estado::class . ':deleteEstado');

$app->run();