<?php
namespace Unit\SimpleRequest\Filter;

use Mcustiel\SimpleRequest\Filter\LowerCase;

class LowerCaseFilterTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED = 'test';
    private $filter;

    public function setUp()
    {
        $this->filter = new LowerCase();
    }

    public function testFilter()
    {
        $this->assertEquals(self::EXPECTED, $this->filter->filter('Test'));
        $this->assertEquals(self::EXPECTED, $this->filter->filter('TEST'));
        $this->assertEquals(self::EXPECTED, $this->filter->filter(self::EXPECTED));
    }
}
