<?php
namespace Unit\Filter;

use Mcustiel\SimpleRequest\Filter\Float;

class FloatFilterTest extends BaseTestForNumericFilters
{
    private $filter;

    public function setUp()
    {
        $this->filter = new Float();
    }

    public function testFloatWithAStringRepresentingAFloat()
    {
        $this->assertEquals(
            4.3, $this->filter->filter('4.3')
        );
    }

    public function testFloatWithAStringRepresentingAnIntegerAsAFloat()
    {
        $this->assertEquals(
            $this->getVariableInfo(4.0), $this->getVariableInfo($this->filter->filter('4.0'))
        );

        $this->assertNotEquals(
            $this->getVariableInfo(4), $this->getVariableInfo($this->filter->filter('4.0'))
        );
    }

    public function testFloatWithAStringRepresentingAnInteger()
    {
        $this->assertEquals(
            43, $this->filter->filter('43')
        );
        $this->assertEquals(
            $this->getVariableInfo(43.0), $this->getVariableInfo($this->filter->filter('43'))
        );
    }

    public function testFloatWithANotNumericString()
    {
        $this->assertEquals(
            0, $this->filter->filter('potato')
        );
    }
}
