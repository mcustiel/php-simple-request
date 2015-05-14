<?php
namespace Integration\Validators;

class EnumTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'enum';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
