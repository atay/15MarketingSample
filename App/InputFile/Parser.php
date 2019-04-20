<?php

namespace App\InputFile;

class Parser {
    public function parsePath($path) {
        $content = \file_get_contents($path);
        return self::parseContent($content);
    }

    public function parseContent($content) {
        $xml = \simplexml_load_string($content);
        $content = \json_decode(\json_encode($xml), true);
        return new File($content);
    }
}