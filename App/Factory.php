<?php

namespace App;

class Factory {

    /**
     * @return \Commands\Base
     */
    public static function createCommand($inputFile, &$response, $repository) {
        switch ($inputFile->getAction()) {
            case InputFile\Actions::ENTER:
                return new Commands\Enter($inputFile, $response, $repository);

            case InputFile\Actions::GET_BALANCE:
                return new Commands\GetBalance($inputFile, $response, $repository);

        }
        throw new \Exception("Missing proper action in the input");
    }

    public static function createActionRepository($inputFile) {
        switch ($inputFile->getAction()) {
            case InputFile\Actions::ENTER:
                return new Repository\Enter;

            case InputFile\Actions::GET_BALANCE:
                return new Repository\GetBalance;
        }
    }
}