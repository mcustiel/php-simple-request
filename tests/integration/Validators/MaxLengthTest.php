<?php
namespace Integration\Validators;

class MaxLengthTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'maxLength';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '123456';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
