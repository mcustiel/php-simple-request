<?php
namespace Integration\Validators;

class AnyOfTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'anyOf';

    public function testBuildARequestWithValidAnyOfBecauseOneOfTheValidatorsValidates()
    {
        $this->request[self::TEST_FIELD] = 5;
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithValidAnyOfBecauseTheOtherOfTheValidatorsValidates()
    {
        $this->request[self::TEST_FIELD] = '192.168.0.1';
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
