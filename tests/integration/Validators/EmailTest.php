<?php
namespace Integration\Validators;

class EmailTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'email';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
