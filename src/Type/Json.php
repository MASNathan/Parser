<?php

namespace MASNathan\Parser\Type;

class Json implements TypeInterface
{
    /**
     * Encodes an array to json strutcture
     * @param  array $data        Data to encode
     * @param  array $prettyPrint True to output the encoded data a little bit more readable for the humans
     * @return string
     */
    public static function encode($data, $prettyPrint = false)
    {
        if ($prettyPrint) {
            return json_encode($data, JSON_PRETTY_PRINT);
        }

        return json_encode($data);
    }

    /**
     * Decodes a json file string
     * @param  string $string File contents
     * @return array
     */
    public static function decode($string)
    {
        return json_decode($string);
    }
}
