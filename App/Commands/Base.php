<?php

namespace App\Commands;

abstract class Base {

    private $inputFile;
    private $response;
    private $dbRepository;


    public function __construct($inputFile, &$response, $dbRepository) {
        $this->inputFile = $inputFile;
        $this->response = $response;
        $this->dbRepository = $dbRepository;
    }

    abstract public function process();

    public function getResponse()
    {
        return $this->response;
    }

}