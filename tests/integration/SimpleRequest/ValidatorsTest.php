<?php
namespace Integration\SimpleRequest;

use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;

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

    public function testBuildARequestAndFilters()
    {
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field custom, was set with invalid value: '0.5'
     */
    public function testBuildARequestWithInvalidCustom()
    {
        $this->request['custom'] = '0.5';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field date, was set with invalid value: '1981-10-17 01:30:00'
     */
    public function testBuildARequestWithInvalidDate()
    {
        $this->request['date'] = '1981-10-17 01:30:00';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field email, was set with invalid value: 'potato'
     */
    public function testBuildARequestWithInvalidEmail()
    {
        $this->request['email'] = 'potato';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field float, was set with invalid value: '5'
     */
    public function testBuildARequestWithInvalidFloatBecauseOfStrict()
    {
        $this->request['float'] = '5';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field float, was set with invalid value: 'nope'
     */
    public function testBuildARequestWithInvalidFloatBecauseOfNotNumeric()
    {
        $this->request['float'] = 'nope';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field integer, was set with invalid value: 'nope'
     */
    public function testBuildARequestWithInvalidInteger()
    {
        $this->request['integer'] = 'nope';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field ipv4, was set with invalid value: '192.256.0.1'
     */
    public function testBuildARequestWithInvalidIpv4()
    {
        $this->request['ipv4'] = '192.256.0.1';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field ipv6, was set with invalid value: '2001:0db8:85a3:08d3:1319:8a2e:0370:733g'
     */
    public function testBuildARequestWithInvalidIpv6()
    {
        $this->request['ipv6'] = '2001:0db8:85a3:08d3:1319:8a2e:0370:733g';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field maxLength, was set with invalid value: '123456'
     */
    public function testBuildARequestWithInvalidMaxLength()
    {
        $this->request['maxLength'] = '123456';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field minLength, was set with invalid value: '1'
     */
    public function testBuildARequestWithInvalidMinLength()
    {
        $this->request['minLength'] = '1';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field notEmpty, was set with invalid value: ''
     */
    public function testBuildARequestWithInvalidNotEmpty()
    {
        $this->request['notEmpty'] = '';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field notNull, was set with invalid value: NULL
     */
    public function testBuildARequestWithInvalidNotNullBecauseItsNull()
    {
        $this->request['notNull'] = null;
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field notNull, was set with invalid value: NULL
     */
    public function testBuildARequestWithInvalidNotNullBecauseItsNotSet()
    {
        unset($this->request['notNull']);
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field regExp, was set with invalid value: '123abc'
     */
    public function testBuildARequestWithInvalidRegExp()
    {
        $this->request['regExp'] = '123abc';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field twitterAccount, was set with invalid value: 'pepe'
     */
    public function testBuildARequestWithInvalidTwitterAccount()
    {
        $this->request['twitterAccount'] = 'pepe';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }

    /**
     * @expectedException Mcustiel\SimpleRequest\Exception\InvalidValueException
     * @expectedExceptionMessage Field url, was set with invalid value: '-:ht:/s//1234.p,s
     */
    public function testBuildARequestWithInvalidUrl()
    {
        $this->request['url'] = '-:ht:/s//1234.p,s';
        $validatorRequest = $this->builder->parseRequest($this->request, AllValidatorsRequest::class);
        $this->assertInstanceOf(AllValidatorsRequest::class, $validatorRequest);
    }
}
