<?php
namespace Integration\Validators;

class MaximumTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'maximum';

    public function testBuildARequestWithInvalidValueBecauseIsOverMaximum()
    {
        $this->request[self::TEST_FIELD] = 8;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function assertRequestParsesCorrectly()
    {
        $this->request[self::TEST_FIELD] = 5;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
