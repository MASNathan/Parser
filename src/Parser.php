<?php

namespace MASNathan\Parser;

use MASNathan\Parser\Data\Content;

class Parser
{
    public static function data($data)
    {
        return new Content($data);
    }

    public static function file($filepath)
    {
        $fileContents = file_get_contents($filepath);

        return self::data($fileContents);
    }
    
    public static function files(array $listOfFiles)
    {
        $listOfContents = array();
        foreach ($listOfFiles as $filepath) {
            $listOfContents[] = self::file($filepath);
        }
        return $listOfContents;
    }
}
