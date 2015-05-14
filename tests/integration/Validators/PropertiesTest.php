<?php
namespace Integration\Validators;

class PropertiesTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'properties';

    public function testBuildARequestWithInvalidValueBecauseOneItemDoesNotPass()
    {
        $this->request[self::TEST_FIELD] = ['key1' => 56, 'key2' => '123456'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseMoreItemsThanAllowed()
    {
        $this->request[self::TEST_FIELD] = ['key1' => 56, 'key2' => '12345', 'key3' => 'Nope'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }
}
