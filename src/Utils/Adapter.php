<?php

namespace JulianoBailao\CrossDocking\Utils;

class Adapter
{
    protected static function converssionData($from, $to)
    {
        $values = [
            'GR' => [
                'KG' => 1/1000,
            ],

            'KG' => [
                'GR' => 1000,
            ],

            'MM' => [
                'CM' => 1/10,
                'M' => 1/1000,
            ],

            'CM' => [
                'MM' => 10,
                'M' => 1/100,
            ],

            'M' => [
                'MM' => 1000,
                'CM' => 100,
            ],
        ];

        return isset($values[$from][$to]) ? $values[$from][$to] : 1;
    }

    public static function unitConverter($value, $unitFrom, $unitTo)
    {
        return (object) [
            'value' => $value * (static::converssionData(strtoupper($unitFrom), strtoupper($unitTo))),
            'unit' => $unitTo,
        ];
    }

    public static function regularizeCharCase($text)
    {
        $result = null;
        $excession = ['da', 'de', 'di', 'do', 'du', 'para', 'por', 'pelo', 'com', 'sem', 'para'];
        $blacklist = ['entusiasta'];
        $replace   = ['P/' => 'para '];

        foreach(explode(' ', strtr($text, $replace)) as $word) {
            if (in_array($word, $blacklist)) {
                continue;
            }

            if (preg_match('/[A-Za-z]/', $word) && preg_match('/[0-9]/', $word)) {
                $result .= mb_strtoupper($word);
            } elseif (in_array($word, $excession)) {
                $result .= mb_strtolower($word);
            }else {
                $result .= ucfirst(mb_strtolower($word));
            }

            $result .= ' ';
        }

        return trim($result);
    }
}
