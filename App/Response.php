<?php

namespace App;

class Response {

    private $data;

    public function __construct()
    {
        $this->data = new \SimpleXMLElement('<service/>');
    }

    public function getData()
    {
        return $this->data;
    }

    public function flush()
    {
        header('Content-type: text/xml');
        print($this->data->asXML());
    }

    public function addDataRecusively($data, &$xml_data) {
        foreach( $data as $key => $value ) {
            if ($key == "@attributes") {
                foreach ($value as $attributeKey => $attributeValue) {
                    $xml_data->addAttribute($attributeKey, $attributeValue);
                }
            } elseif(is_array($value) ) {
                $subnode = $xml_data->addChild($key);
                $this->addDataRecusively($value, $subnode);
            } else {
                $xml_data->addChild($key,htmlspecialchars("$value"));
            }
         }
    }

    public function addArray(array $inputArray) {
        $this->addDataRecusively($inputArray, $this->data);
    }
}