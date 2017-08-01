<?php

namespace JulianoBailao\CrossDocking\Transformers;

use JulianoBailao\CrossDocking\Utils\Adapter;
use JulianoBailao\CrossDocking\Core\Transformer;

class HayamaxTransformer extends Transformer
{
    protected function transform(array $data)
    {
        return array_map(function ($item) {
            return [
                'provider' => [
                    'name' => 'HAYAMAX',
                    'title' => 'Hayamax',
                ],
                'code' => $item['prod_id'],
                'ean' => $item['EAN'],
                'nbm' => $item['NBM'],
                'brand' => $item['brand'],
                'model' => $item['model'],
                'title' => Adapter::regularizeCharCase($item['prod_name']),
                'category' => explode('##', $item['seg_name']),
                'images' => $item['images']['image'],
                'texts' => $item['information'],
                'price' => $item['price'],
                'quantity' => $item['stock'],
                'package' => [
                    'width' => Adapter::unitConverter($item['width'], 'CM', 'MM'),
                    'height' => Adapter::unitConverter($item['height'], 'CM', 'MM'),
                    'depth' => Adapter::unitConverter($item['depth'], 'CM', 'MM'),
                    'weight' => Adapter::unitConverter($item['weightValue'], $item['weightUnit'], 'KG'),
                    'sales_multiple' => Adapter::unitConverter($item['saleQuant'], $item['saleUnit'], 'PC'),
                ],
                'taxes' => [
                    'PPB' => $item['PPB'],
                    'ICS3Perc' => $item['ICS3Perc'],
                    'taxsit' => $item['taxsit'],
                    'ICMSRate' => $item['ICMSRate'],
                    'IPI' => $item['IPI'],
                    'sourceFat' => $item['sourceFat'],
                ],
                'original' => $item,
            ];
        }, $data);
    }
}
