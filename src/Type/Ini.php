<?php

namespace MASNathan\Parser\Type;

class Ini implements TypeInterface
{
    /**
     * Encodes an array to ini strutcture
     * @param  array $data   Data to encode
     * @param  array $parent Parent array, in case of recursive arrays
     * @return string
     */
    public static function encode($data, array $parent = array())
    {
        $data = (array) $data;

        $resultString = '';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                //subsection case
                //merge all the sections into one array...
                $sec = array_merge((array) $parent, (array) $key);
                //add section information to the output
                $resultString .= '[' . join('.', $sec) . ']' . PHP_EOL;
                //recursively traverse deeper
                $resultString .= self::encode($value, $sec);
            } else {
                $resultString .= "$key = $value" . PHP_EOL;
            }
        }

        return trim($resultString, PHP_EOL);
    }

    /**
     * Decodes a ini file string
     * @param  string $string File contents
     * @return array
     */
    public static function decode($string)
    {
        return parse_ini_string($string, true);
    }
}
