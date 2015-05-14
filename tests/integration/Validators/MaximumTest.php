<?php
namespace Integration\Validators;

class ExclusiveMaximumTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'exclusiveMaximum';

    public function testBuildARequestWithInvalidValueBecauseIsOverMaximum()
    {
        $this->request[self::TEST_FIELD] = 8;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseIsEqualToMaximum()
    {
        $this->request[self::TEST_FIELD] = 5;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
