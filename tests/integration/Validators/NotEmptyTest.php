<?php
namespace Integration\Validators;

class NotEmptyTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'notEmpty';

    public function testBuildARequestWithInvalidValueBecauseEmptyString()
    {
        $this->request[self::TEST_FIELD] = '';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseNull()
    {
        $this->failWhenFieldIsNull(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseNotSet()
    {
        unset($this->request[self::TEST_FIELD]);
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
