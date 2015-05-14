<?php
namespace Integration\Validators;

class FloatTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'float';

    public function testBuildARequestWithInvalidValueBecauseOfStrict()
    {
        $this->request[self::TEST_FIELD] = '5';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseOfNotNumeric()
    {
        $this->request[self::TEST_FIELD] = 'nope';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
