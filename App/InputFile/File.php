<?php

namespace App\InputFile;

class File {

    private $content;

    public function __construct($content) {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    private static $actionMap = [
        "enter" => Actions::ENTER,
        "getbalance" => Actions::GET_BALANCE,
    ];

    public function getAction() {
        foreach (self::$actionMap as $fileAction => $systemAction) {
            if ($this->pathExist($fileAction)) {
                return $systemAction;
            }
        }
    }

    public function pathExist($path) {
        return $this->getValueByPath($path) !== null;
    }

    /**
     * Get value from file by path separated by dots, returns nulll if not found
     */
    public function getValueByPath($path) {
        $pathArray = explode(".", $path);
        $currentContent = $this->getContent();
        foreach ($pathArray as $pathElement) {
            if (array_key_exists($pathElement, $currentContent)) {
                $currentContent = $currentContent[$pathElement];
            } else {
                return null;
            }
        }
        return $currentContent;
    }


}