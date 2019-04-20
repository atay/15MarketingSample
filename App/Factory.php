<?php

namespace App;

class Factory {

    /**
     * @return \Commands\Base
     */
    public static function createCommand($inputFile, &$response, $dbRepository) {
        switch ($inputFile->getAction()) {
            case InputFile\Actions::ENTER:
                return new Commands\Enter($inputFile, $response, $dbRepository);

            case InputFile\Actions::GET_BALANCE:
                return new Commands\GetBalance($inputFile, $response, $dbRepository);

        }
        throw new \Exception("Missing proper action in the input");

    }
}