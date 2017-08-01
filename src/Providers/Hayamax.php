<?php

namespace JulianoBailao\CrossDocking\Providers;

use JulianoBailao\CrossDocking\Core\Provider;
use JulianoBailao\CrossDocking\Transformers\HayamaxTransformer;

class Hayamax extends Provider
{
    public function __construct($args)
    {
        $this->setTransformer(new HayamaxTransformer());

        $args = is_array($args) ? $args : func_get_args();
        $host = 'http://webmax.hayamax.com.br/crossdock/servlet/';
        $file = 'CrossDockingServlet.class.php?action=crossDockingPrice&customerId=%s&compress=1&canal=CD';
        parent::__construct(sprintf('%s/%s', $host, sprintf($file, $args[0])), 'product');
    }
}
