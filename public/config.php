<?php
use \MongoDB\Client as Mongo;

class DB {
    public $con;

    function __construct()
    {
        $mongo = new Mongo('mongodb://localhost:27017');
        $collection = $mongo->api->dados;
        $this->con = $collection;
    }
}