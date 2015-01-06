<?php
namespace Unit\Filter;

use Mcustiel\SimpleRequest\Filter\UpperCase;

class UpperCaseFilterTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED = 'TEST';
    private $filter;

    public function setUp()
    {
        $this->filter = new UpperCase();
    }

    public function testFilter()
    {
        $this->assertEquals(self::EXPECTED, $this->filter->filter('Test'));
        $this->assertEquals(self::EXPECTED, $this->filter->filter(self::EXPECTED));
        $this->assertEquals(self::EXPECTED, $this->filter->filter('test'));
    }
}
