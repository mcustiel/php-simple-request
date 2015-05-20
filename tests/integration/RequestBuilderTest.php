<?php
namespace Integration;

use Fixtures\PersonRequest;
use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\Exception\InvalidRequestException;
use Fixtures\CoupleRequest;

class RequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var \Mcustiel\SimpleRequest\RequestBuilder
     */
    private $builderWithCache;
    /**
     *
     * @var \Mcustiel\SimpleRequest\RequestBuilder
     */
    private $builderWithoutCache;

    public function __construct()
    {
        $this->builderWithCache = new RequestBuilder();
        $cacheConfig = new \stdClass();
        $cacheConfig->disabled = true;
        $this->builderWithoutCache = new RequestBuilder($cacheConfig);
    }

    public function testBuildARequestAndFilter()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $parserResponse = $this->builderWithoutCache->parseRequest(
            $request,
            PersonRequest::class,
            RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
        );
        $this->assertPersonIsOk($parserResponse);
    }

    public function testBuildARequestAndFilterWithCacheEnabled()
    {
        $request = [
            'firstName' => '  John  ',
            'lastName' => 'DOE',
            'age' => 30
        ];
        $parserResponse = $this->builderWithCache->parseRequest(
            $request,
            PersonRequest::class,
            RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
        );
        $this->assertPersonIsOk($parserResponse);

        $builderCached = new RequestBuilder();
        $parserResponse = $builderCached->parseRequest(
            $request,
            PersonRequest::class,
            RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
        );
        $this->assertPersonIsOk($parserResponse);
    }

    public function testBuildARequestFromCacheWithPathSpecified()
    {
        $cacheConfig = new \stdClass();
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
        try {
            $this->builderWithoutCache->parseRequest(
                $request,
                PersonRequest::class,
                RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
            );
            $this->fail('Exception expected to be thrown');
        } catch (InvalidRequestException $e) {
            $this->assertTrue(isset($e->getErrors()['firstName']));
        }
    }

    public function testBuildARequestAndValidatorNotNullBecauseFieldIsNull()
    {
        $request = [
            'firstName' => null,
            'lastName' => 'DOE',
            'age' => 30
        ];
        try {
            $this->builderWithoutCache->parseRequest(
                $request,
                PersonRequest::class,
                RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
            );
            $this->fail('Exception expected to be thrown');
        } catch (InvalidRequestException $e) {
            $this->assertTrue(isset($e->getErrors()['firstName']));
        }
    }

    public function testBuildARequestAndValidatorNotNullBecauseFieldDoesNotExist()
    {
        $request = [
            'lastName' => 'DOE',
            'age' => 30
        ];
        try {
            $this->builderWithoutCache->parseRequest(
                $request,
                PersonRequest::class,
                RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
            );
            $this->fail('Exception expected to be thrown');
        } catch (InvalidRequestException $e) {
            $this->assertTrue(isset($e->getErrors()['firstName']));
        }
    }

    public function testBuildARequestWithInstanceOfClassAnnotations()
    {
        $request = [
            'togetherSince' => '2001-09-13',
            'person1' => [
                'firstName' => '  John  ',
                'lastName' => 'DOE',
                'age' => 30
            ],
            'person2' => [
                'firstName' => '  Jane  ',
                'lastName' => 'DoE',
                'age' => 41
            ]
        ];
        /**
         * @var $parserResponse \Fixtures\CoupleRequest
         */
        $parserResponse = $this->builderWithoutCache->parseRequest(
            $request,
            CoupleRequest::class,
            RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
        );
        $this->assertPersonIsOk($parserResponse->getPerson1());
        $personRequest = $parserResponse->getPerson2();
        $this->assertInstanceOf(PersonRequest::class, $personRequest);
        $this->assertEquals('Jane', $personRequest->getFirstName());
        $this->assertEquals('DOE', $personRequest->getLastName());
        $this->assertEquals(41, $personRequest->getAge());
    }

    private function assertPersonIsOk($personRequest)
    {
        $this->assertInstanceOf(PersonRequest::class, $personRequest);
        $this->assertEquals('John', $personRequest->getFirstName());
        $this->assertEquals('DOE', $personRequest->getLastName());
        $this->assertEquals(30, $personRequest->getAge());
    }
}
