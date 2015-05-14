<?php
namespace Integration\Validators;

class Ipv6Test extends AbstractValidatorTest
{
    const TEST_FIELD = 'ipv6';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '2001:0db8:85a3:08d3:1319:8a2e:0370:733g';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
