<?php

namespace Integration\Validators;

use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\ParserResponse;

abstract class AbstractValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $request;
    protected $builder;

    public function setUp()
    {
        $class = new \stdClass();
        $class->key1 = 'val1';
        $class->key2 = 'val2';
        $class->key3 = 'val3';

        $this->request = [
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
        $cacheConfig = new \stdClass();
        $cacheConfig->disabled = true;
        $this->builder = new RequestBuilder($cacheConfig);
    }

    protected function buildRequestAndTestErrorFieldPresent($fieldName)
    {
        $validatorRequest = $this->builder->parseRequest(
            $this->request,
            AllValidatorsRequest::class,
            RequestBuilder::ALL_ERRORS_PARSER
        );
        $this->assertTrue(isset($validatorRequest->getErrors()[$fieldName]));
    }

    protected function assertRequestParsesCorrectly()
    {
        $response = $this->builder->parseRequest($this->request, AllValidatorsRequest::class, RequestBuilder::ALL_ERRORS_PARSER);
        $this->assertInstanceOf(ParserResponse::class, $response);
        $this->assertInstanceOf(AllValidatorsRequest::class, $response->getRequestObject());
    }

    protected function failWhenFieldIsNull($fieldName)
    {
        $this->request[$fieldName] = null;
        $this->buildRequestAndTestErrorFieldPresent($fieldName);
    }
}
