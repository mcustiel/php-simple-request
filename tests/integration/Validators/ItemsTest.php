<?php
namespace Integration\Validators;

class ItemsTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'items';

    public function testBuildARequestWithInvalidValueBecauseOneItemDoesNotPass()
    {
        $this->request[self::TEST_FIELD] = [56, '123456'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseMoreItemsThanAllowed()
    {
        $this->request[self::TEST_FIELD] = [56, '12345', 'Nope'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseOneItemDoesNotPassInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = ['a' => 56, 'potato' => '123456'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseMoreItemsThanAllowedInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = ['a' => 56, 'potato' => '12345', 'nope' => 'Nope'];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = ['a' => 56, 'potato' => '12345'];
        $this->assertRequestParsesCorrectly();
    }
}
