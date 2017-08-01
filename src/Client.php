<?php

namespace JulianoBailao\CrossDocking;

use JulianoBailao\CrossDocking\Utils\Runner;

class Client
{
    public function __call($key, array $args)
    {
        $providerClass = sprintf('JulianoBailao\CrossDocking\Providers\%s', ucfirst($key));

        return new $providerClass($args);
    }
}
