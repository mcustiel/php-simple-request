<?php
namespace Integration;

use Fixtures\PersonRequest;
use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\Exception\InvalidRequestException;
use Fixtures\CoupleRequest;

abstract class TestRequestBuilder extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var \Mcustiel\SimpleRequest\RequestBuilder
     */
    protected $builderWithCache;
    /**
     *
     * @var \Mcustiel\SimpleRequest\RequestBuilder
     */
    protected $builderWithoutCache;

    public function __construct()
    {
        $this->builderWithCache = new RequestBuilder();
        $cacheConfig = new \stdClass();
        $cacheConfig->disabled = true;
        $this->builderWithoutCache = new RequestBuilder($cacheConfig);
    }

    protected function assertPersonIsOk($personRequest)
    {
        $this->assertInstanceOf(PersonRequest::class, $personRequest);
        $this->assertEquals('John', $personRequest->getFirstName());
        $this->assertEquals('DOE', $personRequest->getLastName());
        $this->assertEquals(30, $personRequest->getAge());
    }
}
