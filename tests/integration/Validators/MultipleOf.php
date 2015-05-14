<?php
namespace Integration\Validators;

class MultipleOfTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'multipleOf';

    public function testBuildARequestWithInvalidValueBecauseNotNumber()
    {
        $this->request[self::TEST_FIELD] = 'nope';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueInFloatFormat()
    {
        $this->request[self::TEST_FIELD] = 10.0;
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueInFloatFormat()
    {
        $this->request[self::TEST_FIELD] = 10.5;
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueInIntegerFormat()
    {
        $this->request[self::TEST_FIELD] = 12;
        $this->assertRequestParsesCorrectly();
    }
}
