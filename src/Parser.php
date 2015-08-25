<?php

namespace MASNathan\Parser;

use MASNathan\Parser\Data\Content;

class Parser
{
    /**
     * Creates an object
     * @param  mixed $data Data
     * @return Content
     */
    public static function data($data)
    {
        return new Content($data);
    }

    /**
     * Creates an Object from a file
     * @param  string $filepath File path
     * @return Content
     */
    public static function file($filepath)
    {
        $fileContents = file_get_contents($filepath);

        return self::data($fileContents);
    }
    
    /**
     * Creates an array of objects from multiple files
     * @param  array  $listOfFiles List of file paths
     * @return array
     */
    public static function files(array $listOfFiles)
    {
        $listOfContents = array();
        foreach ($listOfFiles as $key => $filepath) {
            $listOfContents[$key] = self::file($filepath);
        }
        return $listOfContents;
    }
}
