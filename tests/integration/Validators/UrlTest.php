<?php
namespace Integration\Validators;

class UrlTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'url';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '-:ht:/s//1234.p,s';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
