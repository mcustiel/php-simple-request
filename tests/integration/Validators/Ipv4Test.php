<?php
namespace Integration\Validators;

class Ipv4Test extends AbstractValidatorTest
{
    const TEST_FIELD = 'ipv4';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '192.256.0.1';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
