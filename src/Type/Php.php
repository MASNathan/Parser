<?php

namespace MASNathan\Parser\Type;

class Php implements TypeInterface
{
    /**
     * Encodes an array to php serialized string
     * @param  array $data   Data to encode
     * @return string
     */
    public static function encode($data)
    {
        return serialize($data);
    }

    /**
     * Decodes a php serialized string
     * @param  string $string Contents
     * @return array
     */
    public static function decode($string)
    {
        return unserialize($string);
    }
}
