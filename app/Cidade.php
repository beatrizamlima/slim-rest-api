<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

date_default_timezone_set('America/Sao_Paulo');

class Cidade
{
    private $collection;

    function __construct()
    {
        $db = new DB();
        $this->collection = $db->con->cidades;
    }

    public function listCidades(Request $request, Response $response){
        try {
            $result = $this->collection->find()->toArray();

            if($result==NULL){
                return "Nenhuma cidade cadastrada!";
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
            return $error;
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($result, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }

    public function addCidade(Request $request, Response $response){
        $document = $request->getParsedBody();

        foreach ($document as &$file) {
            $file['data_criacao'] = new DateTime();
            $file['data_alteracao'] = new DateTime();
        }

        try {
            $this->collection->insertMany($document);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
            return $error;
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($document, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }

    public function showCidade(Request $request, Response $response){
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');

        try {
            $result = $this->collection->findOne(array('_id' => new MongoDB\BSON\ObjectId($id),));

            if($result==NULL){
                return "Nenhuma cidade com esta ID foi encontrada!";
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
            return $error;
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($result, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }

    public function editCidade(Request $request, Response $response){
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');

        $document = $request->getParsedBody();

        $document['data_alteracao'] = new DateTime();

        try {
            $result = $this->collection->updateOne(
                [ '_id' => new MongoDB\BSON\ObjectId($id) ],
                [ '$set' => $document]
            );
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
            return $error;
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($result, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }

    public function deleteCidade(Request $request, Response $response)
    {
        $route = $request->getAttribute('route');
        $id = $route->getArgument('id');

        try {
            $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
            return $error;
        }

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($result, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }
}