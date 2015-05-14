<?php
namespace Integration\Validators;

class NotNullTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'notNull';

    public function testBuildARequestWithInvalidValueBecauseItsNull()
    {
        $this->failWhenFieldIsNull(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseItsNotSet()
    {
        unset($this->request[self::TEST_FIELD]);
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
