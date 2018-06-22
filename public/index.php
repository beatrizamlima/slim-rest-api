<?php
require '../vendor/autoload.php';
require '../config.php';
require '../app/Estado.php';
require '../app/Cidade.php';

$app = new \Slim\App;

//Rotas Estado
$app->get('/estados', \Estado::class . ':listEstados');

$app->post('/estados', \Estado::class . ':addEstado');

$app->get('/estados/{id}', \Estado::class . ':showEstado');

$app->put('/estados/{id}', \Estado::class . ':editEstado');

$app->delete('/estados/{id}', \Estado::class . ':deleteEstado');

//Rotas Cidade
$app->get('/cidades', \Cidade::class . ':listCidades');

$app->post('/cidades', \Cidade::class . ':addCidade');

$app->get('/cidades/{id}', \Cidade::class . ':showCidade');

$app->put('/cidades/{id}', \Cidade::class . ':editCidade');

$app->delete('/cidades/{id}', \Cidade::class . ':deleteCidade');

$app->run();