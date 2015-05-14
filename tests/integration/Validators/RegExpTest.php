<?php
namespace Integration\Validators;

class RegExpTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'regExp';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = '123abc';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
