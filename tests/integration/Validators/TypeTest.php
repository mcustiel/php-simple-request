<?php
namespace Integration\Validators;

class TypeTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'type';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = 'pepe';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueEmptyArray()
    {
        $this->request[self::TEST_FIELD] = [];
        $this->assertRequestParsesCorrectly(self::TEST_FIELD);
    }
}
