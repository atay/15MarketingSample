<?php

namespace App;

class App
{
    public static function start()
    {
        $response = new Response();
        // $inputFile = InputFile\Parser::parsePath('php://input');
        $inputFile = InputFile\Parser::parsePath('php://stdin');
        $dbRepository = new DbRepository();
        $command = Factory::createCommand($inputFile, $response, $dbRepository);
        $command->process();
        $response->flush();
    }
}