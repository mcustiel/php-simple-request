<?php
namespace Integration\Validators;

class MinItemsTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'minItems';

    public function testBuildARequestWithInvalidValueBecauseUnderMinItems()
    {
        $this->request[self::TEST_FIELD] = [ 'a', 'b' ];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseEqualToMinItems()
    {
        $this->request[self::TEST_FIELD] = [ 'a', 'b', 'c' ];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueBecauseUnderMinItemsInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a' => 'a', 'b' => 'b' ];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseEqualToMinItemsInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c' ];
        $this->assertRequestParsesCorrectly();
    }
}
