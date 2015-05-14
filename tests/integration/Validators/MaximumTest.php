<?php
namespace Integration\Validators;

class ExclusiveMaximumTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'maximum';

    public function testBuildARequestWithInvalidValueBecauseIsOverMaximum()
    {
        $this->request[self::TEST_FIELD] = 8;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseIsEqualToMaximum()
    {
        $this->request[self::TEST_FIELD] = 5;
        $this->assertRequestParsesCorrectly();
    }
}
