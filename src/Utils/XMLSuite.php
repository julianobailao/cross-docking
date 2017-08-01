<?php

namespace JulianoBailao\CrossDocking\Utils;

use JulianoBailao\CrossDocking\Exceptions\InvalidXMLDataException;

class XMLSuite
{
    public static function checkXMLStringData($xmlstr)
    {
        libxml_use_internal_errors(true);
        libxml_clear_errors();
        simplexml_load_string($xmlstr);

        if (count(libxml_get_errors()) > 0) {
            return false;
        }

        return true;
    }

    public static function download($url, $nodeName)
    {
        $xmlstring = file_get_contents($url);

        if (!static::checkXMLStringData($xmlstring)) {
            throw new InvalidXMLDataException($xmlstring);
        }

        $data = [];
        $doc = \DOMDocument::loadXML($xmlstring, LIBXML_NOBLANKS);
        $childs = $doc->getElementsByTagName($nodeName);

        foreach ($childs as $key => $node) {
            $data[$key] = static::serialize($node);
        }

        return $data;
    }

    protected static function serialize($node, $son = false)
    {
        $data = [];

        foreach($node->childNodes as $child) {
            if (static::hasChild($child)) {
                $data[$child->nodeName] = static::serialize($child);
                continue;
            }

            if (isset($data[$child->nodeName])) {
                $data[$child->nodeName] = [$data[$child->nodeName]];
                $data[$child->nodeName][] = $child->textContent;
                continue;
            }

            $data[$child->nodeName] = $child->textContent;
        }

        return json_decode(json_encode($data), true);
    }

    protected static function hasChild($node)
    {
        if ($node->hasChildNodes()) {
            foreach ($node->childNodes as $child) {
                if ($child->nodeType == XML_ELEMENT_NODE) {
                    return true;
                }
            }
        }

        return false;
    }
}
