<?php

namespace App;

class App
{
    public static function start()
    {
        $response = new Response();
        $inputFile = InputFile\Parser::parsePath('php://input');
        $repository = Factory::createActionRepository($inputFile);
        $command = Factory::createCommand($inputFile, $response, $repository);
        $command->process();
        $response->flush();
    }
}