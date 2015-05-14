<?php
namespace Integration\Validators;

class IntegerTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'integer';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = 'nope';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueInFloatFormat()
    {
        $this->request[self::TEST_FIELD] = 1.0;
        $this->assertRequestParsesCorrectly();
    }
}
