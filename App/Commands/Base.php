<?php

namespace App\Commands;

abstract class Base {

    private $inputFile;
    private $response;
    private $repository;


    public function __construct($inputFile, &$response, $repository) {
        $this->inputFile = $inputFile;
        $this->response = $response;
        $this->repository = $repository;
    }

    abstract public function process();

    public function getResponse()
    {
        return $this->response;
    }

}