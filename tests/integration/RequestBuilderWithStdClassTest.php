<?php
namespace Integration;

use Fixtures\PersonRequest;
use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\Exception\InvalidRequestException;
use Fixtures\CoupleRequest;

class RequestBuilderWithStdClassTest extends TestRequestBuilder
{
    public function testBuildARequestAndFilter()
    {
        $request = $this->getValidPersonRequest();

        $parserResponse = $this->builderWithoutCache->parseRequest(
            $request,
            PersonRequest::class,
            RequestBuilder::RETURN_ALL_ERRORS_IN_EXCEPTION
        );
        $this->assertPersonIsOk($parserResponse);
    }

    public function testBuildARequestAndFilterWithCacheEnabled()
    {
        $request = $this->getValidPersonRequest();

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
        $request = new \stdClass();

        $request->anyOf = 5;
        $request->custom = '5';
        $request->date = '17/10/1981 01:30:00';
        $request->email = 'pipicui@hotmail.com';
        $request->enum = 'val1';
        $request->exclusiveMaximum = 3;
        $request->exclusiveMinimum = 8;
        $request->float = '5.1';
        $request->hostName = 'es.wikipedia.org';
        $request->integer = '20';
        $request->ipv4 = '192.168.0.1';
        $request->ipv6 = '2001:0db8:85a3:08d3:1319:8a2e:0370:7334';
        $request->items = [1, '12345'];
        $request->maximum = 3;
        $request->maxItems = [ 'a', 'b' ];
        $request->maxLength = '12345';
        $request->maxProperties = [ 'a', 'b' ];
        $request->minimum = 8;
        $request->minItems = [ 'a', 'b', 'c', 'd' ];
        $request->minLength = '123';
        $request->minProperties = ['a', 'b', 'c', 'd'];
        $request->multipleOf = 5;
        $request->notEmpty = '-';
        $request->notNull = '';
        $request->not = null;
        $request->oneOf = 5;
        $request->properties = ['key1' => 1, 'key2' => '12345'];
        $request->regExp = 'abc123';
        $request->required = $class;
        $request->type = [ 'a' ];
        $request->twitterAccount = '@pepe_123';
        $request->uniqueItems = [ '1', 2, 'potato' ];
        $request->url = 'https://this.isaurl.com/test.php?id=1#test';

        $builder = new RequestBuilder($cacheConfig);
        $builder->parseRequest($request, AllValidatorsRequest::class);
        $builder = new RequestBuilder($cacheConfig);
        $builder->parseRequest($request, AllValidatorsRequest::class);
    }

    public function testBuildARequestAndValidatorNotEmpty()
    {
        $request = $this->getValidPersonRequest();
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
        $request = new \stdClass();
        $request->firstName = null;
        $request->lastName = 'DOE';
        $request->age = 30;

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
        $request = new \stdClass();
        $request->lastName = 'DOE';
        $request->age = 30;

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
        $request = new \stdClass();
        $request->togetherSince = '2001-09-13';

        $person1 = $this->getValidPersonRequest();

        $person2 = new \stdClass();
        $person2->firstName = 'Jane';
        $person2->lastName = 'DoE';
        $person2->age = 41;

        $request->person1 = $person1;
        $request->person2 = $person2;

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

    private function getValidPersonRequest()
    {
        $request = new \stdClass();
        $request->firstName = '  John  ';
        $request->lastName = 'DOE';
        $request->age = 30;

        return $request;
    }
}
