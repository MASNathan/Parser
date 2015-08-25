<?php

namespace MASNathan\Parser\Test;

use MASNathan\Parser\Parser;

/**
 * @coversDefaultClass \MASNathan\Parser\Parser
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testData()
    {
        $data = array(
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
        );

        $content = Parser::data($data);

        $this->assertInstanceOf('MASNathan\\Parser\\Data\\Content', $content);
        $this->assertEquals($data, $content->getData());
    }

    public function testFile()
    {
        $data = array(
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
        );
        $data = json_encode($data);
        $filepath = $this->createTempFile($data);

        $content = Parser::file($filepath);

        $this->assertInstanceOf('MASNathan\\Parser\\Data\\Content', $content);
        $this->assertEquals($data, (string) $content);
    }


    public function testFiles()
    {
        $arrayOfFiles = array();
        $arrayOfContents = array();
        for ($i=0; $i < 10; $i++) {
            $arrayOfContents[$i] = json_encode(array('value' => uniqid()));
            $arrayOfFiles[$i] = $this->createTempFile($arrayOfContents[$i]);
        }

        $contentArray = Parser::files($arrayOfFiles);

        $this->assertTrue(is_array($contentArray));
        $this->assertEquals($arrayOfContents, $contentArray);

        foreach ($contentArray as $key => $content) {
            $this->assertInstanceOf('MASNathan\\Parser\\Data\\Content', $content);
            $this->assertEquals($arrayOfContents[$key], (string) $content);
        }
    }

    protected function createTempFile($contents)
    {
        $temporaryFilePath = tempnam(sys_get_temp_dir(), '');
        if (!file_put_contents($temporaryFilePath, $contents)) {
            throw new \Exception("Error creating temporary file");
        }
        return $temporaryFilePath;
    }
}
