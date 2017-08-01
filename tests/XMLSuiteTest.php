<?php

namespace JulianoBailao\CrossDocking\Tests;

use JulianoBailao\CrossDocking\Utils\XMLSuite;
use JulianoBailao\CrossDocking\Exceptions\InvalidXMLDataException;

class XMLSuiteTest extends TestCase
{
    public function testCheckXMLStringDataWithInvalidData()
    {
        $result = XMLSuite::checkXMLStringData('INVALID_XML_DATA');

        $this->assertFalse($result);
    }

    public function testCheckXMLStringDataWithValidData()
    {
        $result = XMLSuite::checkXMLStringData('<?xml version="1.0" encoding="UTF-8" ?><donkey>VALID_XML_DATA</donkey>');

        $this->assertTrue($result);
    }

    public function testDownloadException()
    {
        $this->expectException(InvalidXMLDataException::class);

        XMLSuite::download('tests/xml/invalid.xml', 'foo');
    }

    public function testRead()
    {
        $result = XMLSuite::download('tests/xml/fake.xml', 'donkey');

        $this->assertTrue($result[0]['type'] == 'VALID_XML_DATA');
    }
}
