<?php

namespace JulianoBailao\CrossDocking\Tests;

use JulianoBailao\CrossDocking\Core\Provider;
use JulianoBailao\CrossDocking\Core\Transformer;

class ProviderTest extends TestCase
{
    public function testBasicGetData()
    {
        $provider = new Provider(sprintf('%s/xml/fake.xml', __DIR__), 'donkey');
        $data = $provider->getData();

        $this->assertEquals('VALID_XML_DATA', $data[0]->type);
    }

    public function testTransformer()
    {
        $stub = $this->getMockForAbstractClass(Transformer::class);

        $stub->expects($this->any())
            ->method('transform')
            ->will($this->returnValue(['donkey' => ['type' => 'FORMATED_XML_DATA']]));

        $provider = new Provider(sprintf('%s/xml/fake.xml', __DIR__), 'donkey');
        $provider->setTransformer($stub);
        $data = $provider->getData();

        $this->assertEquals('FORMATED_XML_DATA', $data['donkey']->type);
    }
}
