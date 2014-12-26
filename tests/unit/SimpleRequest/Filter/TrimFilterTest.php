<?php
namespace Unit\SimpleRequest\Filter;

use Mcustiel\SimpleRequest\Filter\Trim;

class TrimFilterTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED = 'Test';

    private $filter;

    public function setUp()
    {
        $this->filter = new Trim();
    }

    public function testFilter()
    {
        $this->assertEquals(self::EXPECTED, $this->filter->filter(' Test '));
        $this->assertEquals(self::EXPECTED, $this->filter->filter('Test '));
        $this->assertEquals(self::EXPECTED, $this->filter->filter(' Test'));
        $this->assertEquals(self::EXPECTED, $this->filter->filter(' Test
            '));
    }
}
