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
        $result = json_decode($string, true);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $result;

            case JSON_ERROR_DEPTH:
                throw new \Exception("Maximum stack depth exceeded");
            break;
            case JSON_ERROR_STATE_MISMATCH:
                throw new \Exception("Underflow or the modes mismatch");
            break;
            case JSON_ERROR_CTRL_CHAR:
                throw new \Exception("Unexpected control character found");
            break;
            case JSON_ERROR_SYNTAX:
                throw new \Exception("Syntax error, malformed JSON");
            break;
            case JSON_ERROR_UTF8:
                throw new \Exception("Malformed UTF-8 characters, possibly incorrectly encoded");
            break;
            default:
                throw new \Exception("Unknown error on JSON file");
            break;
        }
    }
}
