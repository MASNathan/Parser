<?php

namespace MASNathan\Parser\Type;

use \DOMDocument;
use \DOMElement;
use \DOMText;

class Xml implements TypeInterface
{
    /**
     * Encodes an array to xml strutcture
     * @param  mixed   $data        Data to encode
     * @param  boolean $prettyPrint True to output the encoded data a little bit more readable for the humans
     * @param  string  $xmlVersion  XML header version
     * @param  string  $encoding    XML header encoding
     * @return string
     */
    public static function encode($data, $prettyPrint = false, $xmlVersion = '1.0', $encoding = 'utf-8')
    {
        $domDocument = new DOMDocument($xmlVersion, $encoding);
        $domDocument = self::loopEncode($data, $domDocument);
        
        if ($prettyPrint) {
            $domDocument->preserveWhiteSpace = false;
            $domDocument->formatOutput = true;
        }

        $resultString = $domDocument->saveXML();

        if (!$prettyPrint) {
            $resultStringLines = explode(PHP_EOL, $resultString);
            $documentLine = array_shift($resultStringLines);

            $resultString = $documentLine . PHP_EOL . implode('', $resultStringLines);
        } else {
            $resultString = trim($resultString, PHP_EOL);
        }

        return $resultString;
    }

    /**
     * Lets loop through our data
     * @param  mixed                  $data       Data to encode
     * @param  DOMDocument|DOMElement $domElement Document to initialize and then it'll call itself with inner Element(s)
     * @return DOMDocument
     */
    protected static function loopEncode($data, $domElement)
    {
        if (is_array($data)) {
            foreach ($data as $index => $mixedElement) {
                if (is_int($index)) {
                    if ($index == 0) {
                        $node = $domElement;
                    } else {
                        $node = new DOMElement($domElement->tagName);
                        $domElement->parentNode->appendChild($node);
                    }
                } else {
                    $node = new DOMElement($index);
                    $domElement->appendChild($node);
                }
                 
                self::loopEncode($mixedElement, $node);
            }
        } else {
            $domElement->appendChild(new DOMText($data));
        }

        return $domElement;
    }

    /**
     * Decodes a json file string
     * @param  string $string File contents
     * @return array
     */
    public static function decode($string)
    {
        $xml = simplexml_load_string($string);
        $array = array($xml->getName() => (array) $xml);
        $array = self::loopDecode($array);

        return $array;
    }

    /**
     * Turns all the objects into arrays
     * @param  mixed $data Data
     * @return array
     */
    protected static function loopDecode($data)
    {
        if (is_array($data)) {
            foreach ($data as &$value) {
                $value = self::loopDecode($value);
            }
        } elseif (is_object($data)) {
            return self::loopDecode((array) $data);
        }
        return $data;
    }
}
