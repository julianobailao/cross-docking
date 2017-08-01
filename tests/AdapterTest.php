<?php

namespace JulianoBailao\CrossDocking\Tests;

use JulianoBailao\CrossDocking\Utils\Adapter;

class AdapterTest extends TestCase
{
    public function testUnitConversion()
    {
        $data = Adapter::unitConverter(1, 'M', 'CM');
        $this->assertEquals(100, $data->value);

        $data = Adapter::unitConverter(1, 'M', 'MM');
        $this->assertEquals(1000, $data->value);

        $data = Adapter::unitConverter(10, 'MM', 'CM');
        $this->assertEquals(1, $data->value);

        $data = Adapter::unitConverter(1000, 'MM', 'M');
        $this->assertEquals(1, $data->value);

        $data = Adapter::unitConverter(1, 'CM', 'MM');
        $this->assertEquals(10, $data->value);

        $data = Adapter::unitConverter(100, 'CM', 'M');
        $this->assertEquals(1, $data->value);

        $data = Adapter::unitConverter(1, 'KG', 'GR');
        $this->assertEquals(1000, $data->value);

        $data = Adapter::unitConverter(1000, 'GR', 'KG');
        $this->assertEquals(1, $data->value);
    }

    public function testCharcase()
    {
        $result = Adapter::regularizeCharCase('test para entusiasta xm3456');

        $this->assertEquals('Test para XM3456', $result);
    }
}
