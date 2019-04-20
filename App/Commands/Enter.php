<?php

namespace App\Commands;

class Enter extends Base {

    public function process()
    {
        $commandResponse = [
            "@attributes" => [
                "session" => 1234,
                "time" => "sample time",
            ],
            "enter" => [
                "@attributes" => [
                    "id" => 1345,
                    "results" => "ok"
                ],
                "balance" => [
                    "@attributes" => [
                        "currency" => "RUB",
                        "type" => "real",
                        "value" => 300,
                        "version" => 1,
                    ]
                ]
            ],
        ];
        $this->getResponse()->addArray($commandResponse);


    }
}