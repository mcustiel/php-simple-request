<?php
namespace Integration;

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
        $parserResponse = $builder->parseRequest($request, PersonRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
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
        $parserResponse = $builder->parseRequest($request, PersonRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
        $personRequest = $this->assertPersonIsOk($parserResponse->getRequestObject());

        $builderCached = new RequestBuilder($cacheConfig);
        $parserResponse = $builderCached->parseRequest($request, PersonRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
        $personRequest = $this->assertPersonIsOk($parserResponse->getRequestObject());
    }

    public function testBuildARequestFromCacheWithoutNameSpecified()
    {
        $cacheConfig = new \stdClass();
        $cacheConfig->enabled = true;
        $cacheConfig->path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php-simple-request-alt/';
        $class = new \stdClass();
        $class->key1 = 'val1';
        $class->key2 = 'val2';
        $class->key3 = 'val3';
        $request = [
            'anyOf' => 5,
            'custom' => '5',
            'date' => '17/10/1981 01:30:00',
            'email' => 'pipicui@hotmail.com',
            'enum' => 'val1',
            'exclusiveMaximum' => 3,
            'exclusiveMinimum' => 8,
            'float' => '5.1',
            'integer' => '20',
            'ipv4' => '192.168.0.1',
            'ipv6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334',
            'items' => [1, '12345'],
            'maximum' => 3,
            'maxItems' => [ 'a', 'b' ],
            'maxLength' => '12345',
            'maxProperties' => [ 'a', 'b' ],
            'minimum' => 8,
            'minItems' => [ 'a', 'b', 'c', 'd' ],
            'minLength' => '123',
            'minProperties' => ['a', 'b', 'c', 'd'],
            'multipleOf' => 5,
            'notEmpty' => '-',
            'notNull' => '',
            'not' => null,
            'oneOf' => 5,
            'properties' => ['key1' => 1, 'key2' => '12345'],
            'regExp' => 'abc123',
            'required' => $class,
            'type' => [ 'a' ],
            'twitterAccount' => '@pepe_123',
            'uniqueItems' => [ '1', 2, 'potato' ],
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
        $parserResponse = $builder->parseRequest($request, PersonRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
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
        $parserResponse = $builder->parseRequest($request, PersonRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
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
        $parserResponse = $builder->parseRequest($request, PersonRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
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
