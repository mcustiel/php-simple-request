<?php
namespace Integration\Validators;

class HostNameTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'hostName';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = 'pepe';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

}
