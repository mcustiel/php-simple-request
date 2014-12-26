<?php
namespace Integration\SimpleRequest;

use Fixtures\AllFiltersRequest;
use Mcustiel\SimpleRequest\RequestBuilder;

class FiltersTest extends \PHPUnit_Framework_TestCase
{
    const TEST_VALUE = 'test ONE Two';
    private $request;
    private $builder;

    public function setUp() {
        $this->request = [
            'custom' => self::TEST_VALUE,
            'capitalize' => self::TEST_VALUE,
            'upperCase' => self::TEST_VALUE,
            'lowerCase' => self::TEST_VALUE
        ];
        $this->builder = new RequestBuilder();
    }

    public function testBuildARequestAndFilters()
    {
        $filterRequest = $this->builder->parseRequest($this->request, AllFiltersRequest::class);
        $this->assertInstanceOf(AllFiltersRequest::class, $filterRequest);
        $request = $filterRequest->parse($this->request);
        $this->assertEquals('Test One Two', $request->getCustom());
        $this->assertEquals('Test one two', $request->getCapitalize());
        $this->assertEquals('TEST ONE TWO', $request->getUpperCase());
        $this->assertEquals('test one two', $request->getLowerCase());
    }
}
