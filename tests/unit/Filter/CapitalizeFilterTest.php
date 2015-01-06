<?php
namespace Unit\Filter;

use Mcustiel\SimpleRequest\Filter\Capitalize;
class CapitalizeFilterTest extends \PHPUnit_Framework_TestCase
{
    const EXPECTED_FIRST_WORD = 'Test';
    const EXPECTED_ALL_WORDS = 'Test Text';

    private $filter;

    public function setUp()
    {
        $this->filter = new Capitalize();
    }

    public function testCapitalizeFirstWord()
    {
        $this->assertEquals(
            self::EXPECTED_FIRST_WORD, $this->filter->filter(self::EXPECTED_FIRST_WORD)
        );
        $this->assertEquals(self::EXPECTED_FIRST_WORD, $this->filter->filter('TEST'));
        $this->assertEquals(self::EXPECTED_FIRST_WORD, $this->filter->filter('test'));
    }

    public function testCapitalizeAllWords()
    {
        $this->filter->setSpecification(true);
        $this->assertEquals(
            self::EXPECTED_ALL_WORDS, $this->filter->filter(self::EXPECTED_ALL_WORDS)
        );
        $this->assertEquals(self::EXPECTED_ALL_WORDS, $this->filter->filter('TEST TEXT'));
        $this->assertEquals(self::EXPECTED_ALL_WORDS, $this->filter->filter('test text'));
    }
}
