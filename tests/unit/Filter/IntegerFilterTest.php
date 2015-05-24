<?php
namespace Unit\Filter;

use Mcustiel\SimpleRequest\Filter\Integer;

class IntegerFilterTest extends BaseTestForNumericFilters
{
    private $filter;

    public function setUp()
    {
        $this->filter = new Integer();
    }

    public function testIntegerWithAStringRepresentingAInteger()
    {
        $this->assertEquals(
            4, $this->filter->filter('4')
        );
    }

    public function testIntegerWithAStringRepresentingAnIntegerAsFloat()
    {
        $this->assertEquals(
            $this->getVariableInfo(4), $this->getVariableInfo($this->filter->filter('4.0'))
        );

        $this->assertNotEquals(
            $this->getVariableInfo(4.0), $this->getVariableInfo($this->filter->filter('4.0'))
        );
    }

    public function testIntegerWithAStringRepresentingAnFloat()
    {
        $this->assertEquals(
            4, $this->filter->filter('4.3')
        );
        $this->assertEquals(
            $this->getVariableInfo(4), $this->getVariableInfo($this->filter->filter('4.3'))
        );
    }

    public function testIntegerWithANotNumericString()
    {
        $this->assertEquals(
            0, $this->filter->filter('potato')
        );
    }
}
