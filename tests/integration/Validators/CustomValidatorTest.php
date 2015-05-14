<?php
namespace Integration\Validators;

class CustomValidatorTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'custom';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '0.5';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
