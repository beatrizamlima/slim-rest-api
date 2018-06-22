<?php
use \MongoDB\Client as Mongo;

//Classe do Mongo
class DB {
    public $con;

    // Constrói objeto de banco e seta host e database
    function __construct()
    {
        //Seta host do banco
        $mongo = new Mongo('mongodb://localhost:27017');
        //Seta database
        $conection = $mongo->api;
        //Atribui conexão do banco a variável con do objeto DB
        $this->con = $conection;
    }
}