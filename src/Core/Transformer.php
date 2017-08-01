<?php

namespace JulianoBailao\CrossDocking\Core;

use JulianoBailao\CrossDocking\Exceptions\TransformerMustReturnArrayException;

abstract class Transformer
{
    protected $data;

    abstract protected function transform(array $data);

    public function transformData(array $data)
    {
        $newData = $this->transform($data);

        if (!is_array($newData)) {
            throw new TransformerMustReturnArrayException('Transformer error: the transform method must return an array.');
        }

        return $newData;
    }
}
