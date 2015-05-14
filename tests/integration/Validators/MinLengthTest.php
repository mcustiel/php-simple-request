<?php
namespace Integration\Validators;

class MinLengthTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'minLength';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '1';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
