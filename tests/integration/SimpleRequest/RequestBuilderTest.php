<?php
namespace Integration\SimpleRequest;

use Fixtures\PersonRequest;
use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;

class RequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildARequestAndFilter()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $parserResponse = $builder->parseRequest($request, PersonRequest::class);
        $personRequest = $this->assertPersonIsOk($parserResponse->getRequestObject());
    }

    public function testBuildARequestAndFilterWithCacheEnabled()
    {
        $cacheConfig = new \stdClass();
        $cacheConfig->enabled = true;

        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder($cacheConfig);
        $parserResponse = $builder->parseRequest($request, PersonRequest::class);
        $personRequest = $this->assertPersonIsOk($parserResponse->getRequestObject());

        $builderCached = new RequestBuilder($cacheConfig);
        $parserResponse = $builderCached->parseRequest($request, PersonRequest::class);
        $personRequest = $this->assertPersonIsOk($parserResponse->getRequestObject());
    }

    public function testBuildARequestFromCacheWithoutNameSpecified()
    {
        $cacheConfig = new \stdClass();
        $cacheConfig->enabled = true;
        $cacheConfig->path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-simple-request-alt/';

        $request = [
            'custom' => '5',
            'date' => '17/10/1981 01:30:00',
            'email' => 'pipicui@hotmail.com',
            'float' => '5.1',
            'integer' => '20',
            'ipv4' => '192.168.0.1',
            'ipv6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334',
            'maxLength' => '12345',
            'minLength' => '123',
            'notEmpty' => '-',
            'notNull' => '',
            'regExp' => 'abc123',
            'twitterAccount' => '@pepe_123',
            'url' => 'https://this.isaurl.com/test.php?id=1#test'
        ];
        $builder = new RequestBuilder($cacheConfig);
        $builder->parseRequest($request, AllValidatorsRequest::class);
        $builder = new RequestBuilder($cacheConfig);
        $builder->parseRequest($request, AllValidatorsRequest::class);
    }

    public function testBuildARequestAndValidatorNotEmpty()
    {
        $request = [
            'firstName' => '',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $parserResponse = $builder->parseRequest($request, PersonRequest::class);
        $this->assertFalse($parserResponse->isValid());
        $this->assertTrue(isset($parserResponse->getErrors()['firstName']));
    }

    public function testBuildARequestAndValidatorNotNullBecauseFieldIsNull()
    {
        $request = [
            'firstName' => null,
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $parserResponse = $builder->parseRequest($request, PersonRequest::class);
        $this->assertFalse($parserResponse->isValid());
        $this->assertTrue(isset($parserResponse->getErrors()['firstName']));
    }

    public function testBuildARequestAndValidatorNotNullBecauseFieldDoesNotExist()
    {
        $request = [
            'lastName' => 'DOE',
            'age' => 30
        ];
        $builder = new RequestBuilder();
        $parserResponse = $builder->parseRequest($request, PersonRequest::class);
        $this->assertFalse($parserResponse->isValid());
        $this->assertTrue(isset($parserResponse->getErrors()['firstName']));
    }

    private function assertPersonIsOk($personRequest)
    {
        $this->assertInstanceOf(PersonRequest::class, $personRequest);
        $this->assertEquals('John', $personRequest->getFirstName());
        $this->assertEquals('DOE', $personRequest->getLastName());
        $this->assertEquals(30, $personRequest->getAge());
        return $personRequest;
    }
}
