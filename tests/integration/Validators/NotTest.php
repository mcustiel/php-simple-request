<?php
namespace Integration\Validators;

class NotTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'not';

    public function testBuildARequestWithInvalidValueBecauseIsNotNull()
    {
        $this->request[self::TEST_FIELD] = 'a value';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseIsAnEmptyString()
    {
        $this->request[self::TEST_FIELD] = '';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseNull()
    {
        $this->request[self::TEST_FIELD] = null;
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithValidValueBecauseNotSet()
    {
        unset($this->request[self::TEST_FIELD]);
        $this->assertRequestParsesCorrectly(self::TEST_FIELD);
    }
}
