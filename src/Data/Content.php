<?php

namespace MASNathan\Parser\Data;

use MASNathan\Parser\Type\Ini;
use MASNathan\Parser\Type\Json;
use MASNathan\Parser\Type\Php;
use MASNathan\Parser\Type\Xml;
use MASNathan\Parser\Type\Yaml;

class Content
{
    /**
     * Original content used on the constructor
     * @var string
     */
    protected $string;

    /**
     * Data holder
     * @var array
     */
    protected $data;

    /**
     * Pretty Output flag
     * @var boolean
     */
    protected $prettyOutput = false;

    /**
     * Sets the original content
     * @param string $content Content
     */
    public function __construct($content = null)
    {
        if (is_string($content)) {
            $this->string = $content;
        } else {
            $this->data = $content;
        }
    }

    /**
     * Magic toString method
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }

    public function setPrettyOutput($prettyOutput)
    {
        $this->prettyOutput = (bool) $prettyOutput;
        return $this;
    }

    /**
     * Returns the data value
     * @return array Data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns the content as an array
     * @return array
     */
    public function toArray()
    {
        return (array) $this->data;
    }

    /**
     * Specifies the structure type which the content will be parsed from
     * @param  string $type Type [ini, json, php, xml or yaml]
     * @return Content
     */
    public function from($type)
    {
        switch ($type) {
            case 'ini':
                $this->data = Ini::decode($this->string);
                break;

            case 'json':
                $this->data = Json::decode($this->string);
                break;

            case 'php':
                $this->data = Php::decode($this->string);
                break;

            case 'xml':
                $this->data = Xml::decode($this->string);
                break;

            case 'yml':
            case 'yaml':
                $this->data = Yaml::decode($this->string);
                break;
            
            default:
                throw new \Exception("Format not supported: " . $type);
        }

        return $this;
    }

    /**
     * Specifies the format you want to encode the data to
     * @param  string $type Type [ini, json, php, xml or yaml]
     * @return string
     */
    public function to($type)
    {
        switch ($type) {
            case 'ini':
                $this->string = Ini::encode($this->data);
                break;

            case 'json':
                $this->string = Json::encode($this->data, $this->prettyOutput);
                break;

            case 'php':
                $this->string = Php::encode($this->data);
                break;

            case 'xml':
                $this->string = Xml::encode($this->data, $this->prettyOutput);
                break;

            case 'yml':
            case 'yaml':
                $this->string = Yaml::encode($this->data);
                break;
            
            default:
                throw new \Exception("Format not supported: " . $type);
        }

        return $this->string;
    }
}
