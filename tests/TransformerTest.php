<?php

namespace JulianoBailao\CrossDocking\Tests;

use JulianoBailao\CrossDocking\Core\Transformer;
use JulianoBailao\CrossDocking\Exceptions\TransformerMustReturnArrayException;

class TransformerTest extends TestCase
{
    public function testException()
    {
        $this->expectException(TransformerMustReturnArrayException::class);

        $stub = $this->getMockForAbstractClass(Transformer::class);
        $stub->expects($this->any())
            ->method('transform')
            ->will($this->returnValue('donkey!'));

        $stub->transformData(['foo' => 'bar']);
    }

    public function testTransform()
    {
        $stub = $this->getMockForAbstractClass(Transformer::class);
        $stub->expects($this->any())
            ->method('transform')
            ->will($this->returnValue(['foo' => 'This is my donkey']));

        $data = $stub->transformData(['foo' => 'bar']);

        $this->assertEquals('This is my donkey', $data['foo']);
    }
}
