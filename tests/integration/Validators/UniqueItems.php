<?php
namespace Integration\Validators;

class UniqueItemsTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'uniqueItems';

    public function testBuildARequestWithInvalidValueBecauseNotArray()
    {
        $this->request[self::TEST_FIELD] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseDuplicatedValue()
    {
        $this->request[self::TEST_FIELD][] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseEmptyArray()
    {
        $this->request[self::TEST_FIELD] = [];
        $this->assertRequestParsedCorrectly();
    }
}
