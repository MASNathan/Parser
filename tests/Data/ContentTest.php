<?php

namespace MASNathan\Parser\Test\Data;

use MASNathan\Parser\Parser;

/**
 * @coversDefaultClass \MASNathan\Parser\Data\Content
 */
class ContentTest extends \PHPUnit_Framework_TestCase
{
   


    public function encodeDecodeTemplates()
    {
        $dataSimple = array(
            'key1' => 'value1',
            'key2' => 'value2',
        );

        $templates = array(
            'simple' => array()
        );

        $templates['simple']['ini'] = <<<TEMPLATE
key1 = value1
key2 = value2
TEMPLATE;

        $templates['simple']['json'] = <<<TEMPLATE
{"key1":"value1","key2":"value2"}
TEMPLATE;

        $templates['simple']['json_pretty'] = <<<TEMPLATE
{
    "key1": "value1",
    "key2": "value2"
}
TEMPLATE;

        $templates['simple']['xml'] = <<<TEMPLATE
<?xml version="1.0" encoding="utf-8"?>
<root><key1>value1</key1><key2>value2</key2></root>
TEMPLATE;

        $templates['simple']['xml_pretty'] = <<<TEMPLATE
<?xml version="1.0" encoding="utf-8"?>
<root>
  <key1>value1</key1>
  <key2>value2</key2>
</root>
TEMPLATE;

        return array(
            array($dataSimple, $templates['simple']['ini'], 'ini', false),
            array($dataSimple, $templates['simple']['json'], 'json', false),
            array($dataSimple, $templates['simple']['json_pretty'], 'json', true),
            array(array('root' => $dataSimple), $templates['simple']['xml'], 'xml', false),
            array(array('root' => $dataSimple), $templates['simple']['xml_pretty'], 'xml', true),
        );
    }
    /**
     * @param $dataArray
     * @param $expectedString
     * @param $format
     * @param $ouputPretty
     *
     * @dataProvider encodeDecodeTemplates
     */
    public function testEncodeDecode($dataArray, $expectedString, $format, $ouputPretty = false)
    {
        $contentArray = Parser::data($dataArray);
        $contentArray->setPrettyOutput($ouputPretty);

        $dataString = $contentArray->to($format);
        dump($expectedString, $dataString, $format, $ouputPretty);
        $this->assertEquals($expectedString, $dataString);
        
        $contentString = Parser::data($dataString)->from($format);
        $this->assertEquals($dataArray, $contentString->toArray());
    }
}
