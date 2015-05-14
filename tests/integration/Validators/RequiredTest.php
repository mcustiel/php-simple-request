<?php
namespace Integration\Validators;

class RequiredTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'required';

    public function testBuildARequestWithInvalidValueInAStdClass()
    {
        $class = new \stdClass();
        $class->key1 = 'val1';
        $class->key3 = 'val3';

        $this->request[self::TEST_FIELD] = $class;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidArray()
    {
        $this->request[self::TEST_FIELD] = ['key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3'];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueInAnArray()
    {
        $this->request[self::TEST_FIELD] = ['key1' => 'val1', 'key3' => 'val3'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
