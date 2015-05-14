<?php
namespace Integration\Validators;

class DateTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'date';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '1981-10-17 01:30:00';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
