<?php

namespace JulianoBailao\CrossDocking\Tests;

use JulianoBailao\CrossDocking\Providers\Hayamax;

class HayamaxTest extends TestCase
{
    public function testBasicGetData()
    {
        $hayamax = new Hayamax('CLIENT_ID');
        $hayamax->setUrl(sprintf('%s/xml/hayamax.xml', __DIR__));
        $data = $hayamax->getData();

        $this->assertEquals('HAYAMAX', $data[0]->provider->name);
    }
}
