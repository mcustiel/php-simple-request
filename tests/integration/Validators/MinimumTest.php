<?php
namespace Integration\Validators;

class MinimumTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'minimum';

    public function testBuildARequestWithInvalidValueBecauseIsLessThanMinimum()
    {
        $this->request[self::TEST_FIELD] = 3;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseIsEqualToMinimum()
    {
        $this->request[self::TEST_FIELD] = 5;
        $this->assertRequestParsesCorrectly(self::TEST_FIELD);
    }
}
