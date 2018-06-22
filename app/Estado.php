<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

date_default_timezone_set('America/Sao_Paulo');

class Estado
{
	private $collection;

	function __construct()
	{
		$db = new DB();
		$this->collection = $db->con->estados;
	}

	public function listEstados(Request $request, Response $response){
	    //Pega os parâmetros da query string
        $params = $request->getQueryParams();

        try {
            //Procura os estados no banco
	    	$result = $this->collection->find($params, [
                'sort' => ['nome' => 1,'data_criacao' => -1],
            ])->toArray();

	    	if($result==NULL){
	    		return "Nenhum estado cadastrado!";
	    	}
	    } catch (MongoDB\Driver\Exception\Exception $e) {
	    	$error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
	    	return $error;
	    }
		
		return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($result, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
	}

	public function addEstado(Request $request, Response $response){
	    //Pega o JSON passado na request
    	$document = $request->getParsedBody();

    	//Adiciona data de criação e alteração no documento antes de salvar
	    foreach ($document as &$file) {
	    	$file['data_criacao'] = new DateTime();
	    	$file['data_alteracao'] = new DateTime();
	    }
		
		try {
	        //Insere os estados
	    	$this->collection->insertMany($document);
	    } catch (MongoDB\Driver\Exception\Exception $e) {
	    	$error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
	    	return $error;
	    }
		
		return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($document, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
	}

	public function showEstado(Request $request, Response $response){
	    //Pega a ID do estado passada na rota
		$route = $request->getAttribute('route');
    	$id = $route->getArgument('id');

    	try {
    	    //Procura o estado no banco baseado na ID
	    	$result = $this->collection->findOne(array('_id' => new MongoDB\BSON\ObjectId($id),));

	    	if($result==NULL){
	    		return "Nenhum estado com esta ID foi encontrado!";
	    	}
	    } catch (MongoDB\Driver\Exception\Exception $e) {
	    	$error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
	    	return $error;
	    }
		
    	return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($result, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
	}

	public function editEstado(Request $request, Response $response){
	    //Pega a ID do estado passada na rota
		$route = $request->getAttribute('route');
	    $id = $route->getArgument('id');

        //Pega o JSON passado na request
	    $document = $request->getParsedBody();

	    //Muda a data de alteração do documento
		$document['data_alteracao'] = new DateTime();

		try {
		    //Atualiza o documento
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

	public function deleteEstado(Request $request, Response $response)
	{
        //Pega a ID do estado passada na rota
		$route = $request->getAttribute('route');
    	$id = $route->getArgument('id');
		
		try {
		    //Deleta o estado baseado na ID
			$result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
	    } catch (MongoDB\Driver\Exception\Exception $e) {
	    	$error =  "error message: ".$e->getMessage()."\n"."error code: ".$e->getCode()."\n";
	    	return $error;
	    }

    	return $response->withHeader('Content-Type', 'application/json')->withStatus(200)->withJson($result, null, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
	}
}