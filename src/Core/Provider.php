<?php

namespace JulianoBailao\CrossDocking\Core;

use JulianoBailao\CrossDocking\Utils\XMLSuite;
use JulianoBailao\CrossDocking\Utils\Collection;

class Provider
{
    protected $url;

    protected $nodeName;

    protected $transformer;

    public function __construct($url, $nodeName)
    {
        $this->url = $url;
        $this->nodeName = $nodeName;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setTransformer(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function getData()
    {
        $data = XMLSuite::download($this->url, $this->nodeName);

        if ($this->transformer) {
            $data = $this->transformer->transformData($data);
        }

        return array_map(function ($item) {
            return json_decode(json_encode($item));
        }, $data);
    }
}
