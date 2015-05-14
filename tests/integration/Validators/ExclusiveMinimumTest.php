<?php
namespace Integration\Validators;

class ExclusiveMinimumTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'exclusiveMinimum';

    public function testBuildARequestWithInvalidValueBecauseIsLessThanMinimum()
    {
        $this->request[self::TEST_FIELD] = 3;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseIsEqualToMinimum()
    {
        $this->request[self::TEST_FIELD] = 5;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
