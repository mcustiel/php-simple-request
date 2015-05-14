<?php
namespace Integration\Validators;

class MaxItemsTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'maxItems';

    public function testBuildARequestWithInvalidValueBecauseOverMaxItems()
    {
        $this->request[self::TEST_FIELD] = [ 'a', 'b', 'c', 'nope' ];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseEqualToMaxProperties()
    {
        $this->request[self::TEST_FIELD] = [ 'a', 'b', 'c' ];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueBecauseOverMaxItemsInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c', 'nope' => 'Nope' ];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueBecauseEqualToMaxPropertiesInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c' ];
        $this->assertRequestParsesCorrectly();
    }
}
