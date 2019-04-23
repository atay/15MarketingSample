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

    public function getInputFile()
    {
        return $this->inputFile;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function arrayMergeDeep($arrays) {
        $result = array();
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (is_integer($key)) {
                    $result[] = $value;
                }
                elseif (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                    $result[$key] = $this->arrayMergeDeep(array(
                        $result[$key],
                        $value,
                    ));
                }
                else {
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }

}