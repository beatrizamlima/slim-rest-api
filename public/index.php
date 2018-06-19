<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'config.php';

$app = new \Slim\App;

$container = $app->getContainer();

$app->get('/cidades', function (Request $request, Response $response) {
    $db = new DB();
    $result = $db->con->find()->toArray();

    return json_encode($result);
});

$app->post('/cidades', function (Request $request, Response $response) {
    $document = $request->getParsedBody();

    $db = new DB();
    $db->con->insertMany($document);

    return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($document, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
});

$app->run();