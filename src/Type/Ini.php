<?php

namespace MASNathan\Parser\Type;

class Ini implements TypeInterface
{
    /**
     * Encodes an array to ini strutcture
     * @param  array $data   Data to encode
     * @return string
     */
    public static function encode($data)
    {
        $data = (array) $data;

        $resultString = self::loopEncode($data);

        return trim($resultString, PHP_EOL);
    }

    /**
     * Method to look the data and encode it to ini format
     * @param  array $data   Data to encode
     * @param  array $parent Parent array, in case of recursive arrays
     * @return string
     */
    public static function loopEncode($data, array $parent = array())
    {
        $resultString = '';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                //subsection case
                //merge all the sections into one array...
                $sec = array_merge((array) $parent, (array) $key);
                //add section information to the output
                $resultString .= PHP_EOL . '[' . join('.', $sec) . ']' . PHP_EOL;
                //recursively traverse deeper
                $resultString .= self::loopEncode($value, $sec);
            } else {
                $resultString .= "$key = $value" . PHP_EOL;
            }
        }

        return $resultString;
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
