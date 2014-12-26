<?php
namespace Integration\SimpleRequest;

use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\ParserResponse;

class ValidatorsTest extends \PHPUnit_Framework_TestCase
{
    private $request;
    private $builder;


    public function setUp() {
        $this->request = [
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
        $this->builder = new RequestBuilder();
    }

    public function testBuildARequestAndValidators()
    {
        $response = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(ParserResponse::class, $response);
        $this->assertInstanceOf(AllValidatorsRequest::class, $response->getRequestObject());
    }

    public function testBuildARequestWithInvalidCustom()
    {
        $this->request['custom'] = '0.5';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['custom']));
    }

    public function testBuildARequestWithInvalidDate()
    {
        $this->request['date'] = '1981-10-17 01:30:00';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['date']));
    }

    public function testBuildARequestWithInvalidEmail()
    {
        $this->request['email'] = 'potato';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['email']));
    }

    public function testBuildARequestWithInvalidFloatBecauseOfStrict()
    {
        $this->request['float'] = '5';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['float']));
    }

    public function testBuildARequestWithInvalidFloatBecauseOfNotNumeric()
    {
        $this->request['float'] = 'nope';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['float']));
    }

    public function testBuildARequestWithInvalidInteger()
    {
        $this->request['integer'] = 'nope';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['integer']));
    }

    public function testBuildARequestWithInvalidIpv4()
    {
        $this->request['ipv4'] = '192.256.0.1';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['ipv4']));
    }

    public function testBuildARequestWithInvalidIpv6()
    {
        $this->request['ipv6'] = '2001:0db8:85a3:08d3:1319:8a2e:0370:733g';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['ipv6']));
    }

    public function testBuildARequestWithInvalidMaxLength()
    {
        $this->request['maxLength'] = '123456';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['maxLength']));
    }

    public function testBuildARequestWithInvalidMinLength()
    {
        $this->request['minLength'] = '1';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['minLength']));
    }

    public function testBuildARequestWithInvalidNotEmpty()
    {
        $this->request['notEmpty'] = '';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['notEmpty']));
    }

    public function testBuildARequestWithInvalidNotNullBecauseItsNull()
    {
        $this->request['notNull'] = null;
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['notNull']));
    }

    public function testBuildARequestWithInvalidNotNullBecauseItsNotSet()
    {
        unset($this->request['notNull']);
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['notNull']));
    }

    public function testBuildARequestWithInvalidRegExp()
    {
        $this->request['regExp'] = '123abc';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['regExp']));
    }

    public function testBuildARequestWithInvalidTwitterAccount()
    {
        $this->request['twitterAccount'] = 'pepe';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['twitterAccount']));
    }

    public function testBuildARequestWithInvalidUrl()
    {
        $this->request['url'] = '-:ht:/s//1234.p,s';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertTrue(isset($validatorRequest->getErrors()['url']));
    }
}
