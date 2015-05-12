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
            'custom' => '5',
            'date' => '17/10/1981 01:30:00',
            'email' => 'pipicui@hotmail.com',
            'float' => '5.1',
            'integer' => '20',
            'ipv4' => '192.168.0.1',
            'ipv6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334',
            'items' => [1, '12345'],
            'maxLength' => '12345',
            'minLength' => '123',
            'notEmpty' => '-',
            'notNull' => '',
            'regExp' => 'abc123',
            'required' => $class,
            'twitterAccount' => '@pepe_123',
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
}
