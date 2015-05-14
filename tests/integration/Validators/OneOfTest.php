<?php
namespace Integration\Validators;

class OneOfTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'oneOf';

    public function testBuildARequestWithValidOneOfBecauseOneOfTheValidatorsValidates()
    {
        $this->request[self::TEST_FIELD] = 5;
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithValidOneOfBecauseOtherTheValidatorsValidates()
    {
        $this->request[self::TEST_FIELD] = '192.168.0.1';
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueBecauseNoValidatorValidates()
    {
        $this->request[self::TEST_FIELD] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseMoreThanOneValidatorValidates()
    {
        $this->request[self::TEST_FIELD] = 3;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
