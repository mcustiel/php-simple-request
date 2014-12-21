<?php
namespace Integration\SimpleRequest;

use Fixtures\PersonRequest;
use Mcustiel\SimpleRequest\RequestBuilder;

class RequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildARequestAndFilters()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $personRequest = $builder->parseRequest($request, PersonRequest::class);
        $this->assertInstanceOf(PersonRequest::class, $personRequest);
        $this->assertEquals('John', $personRequest->getFirstName());
        $this->assertEquals('DOE', $personRequest->getLastName());
        $this->assertEquals(30, $personRequest->getAge());
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field firstName, was set with invalid value: ''
     */
    public function testBuildARequestAndValidatorNotEmpty()
    {
        $request = [
            'firstName' => '',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $personRequest = $builder->parseRequest($request, PersonRequest::class);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field firstName, was set with invalid value: NULL
     */
    public function testBuildARequestAndValidatorNotNullBecauseFieldIsNull()
    {
        $request = [
            'firstName' => null,
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $personRequest = $builder->parseRequest($request, PersonRequest::class);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field firstName, was set with invalid value: NULL
     */
    public function testBuildARequestAndValidatorNotNullBecauseFieldDoesNotExist()
    {
        $request = [
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $personRequest = $builder->parseRequest($request, PersonRequest::class);
    }
}
