<?php

namespace JulianoBailao\CrossDocking\Tests;

use JulianoBailao\CrossDocking\Client;
use JulianoBailao\CrossDocking\Providers\Hayamax;

class ClientTest extends TestCase
{
    public function testCall()
    {
        $client = new Client();

        $this->assertTrue($client->hayamax('CLIENT_ID') instanceof Hayamax);
    }
}
