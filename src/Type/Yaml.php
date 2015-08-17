<?php

namespace MASNathan\Parser\Type;

use Symfony\Component\Yaml\Yaml as YamlParser;

class Yaml implements TypeInterface
{
    /**
     * Encodes an array to yaml strutcture
     * @param  array $data   Data to encode
     * @param  int   $inline The level where you switch to inline YAML
     * @return string
     */
    public static function encode($data, $inline = 4)
    {
        return YamlParser::dump($data, $inline);
    }

    /**
     * Decodes a yaml string
     * @param  string $string Contents
     * @return array
     */
    public static function decode($string)
    {
        return YamlParser::parse($string);
    }
}
