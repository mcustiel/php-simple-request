<?php
namespace Integration\SimpleRequest;

use Fixtures\AllFiltersRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\ParserResponse;

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
        $parserResponse = $this->builder->parseRequest($this->request, AllFiltersRequest::class);

        $this->assertInstanceOf(ParserResponse::class, $parserResponse);
        $request = $parserResponse->getRequestObject();
        $this->assertInstanceOf(AllFiltersRequest::class, $request);
        $this->assertEquals('Test One Two', $request->getCustom());
        $this->assertEquals('Test one two', $request->getCapitalize());
        $this->assertEquals('TEST ONE TWO', $request->getUpperCase());
        $this->assertEquals('test one two', $request->getLowerCase());
    }
}
