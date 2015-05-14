<?php
namespace Integration\Validators;

class ItemsTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValueBecauseOneItemDoesNotPass()
    {
        $this->request['items'] = [56, '123456'];
        $this->buildRequestAndTestErrorFieldPresent('items');
    }

    public function testBuildARequestWithInvalidValueBecauseMoreItemsThanAllowed()
    {
        $this->request['items'] = [56, '12345', 'Nope'];
        $this->buildRequestAndTestErrorFieldPresent('items');
    }

    public function testBuildARequestWithInvalidValueBecauseOneItemDoesNotPassInAssociativeArray()
    {
        $this->request['items'] = ['a' => 56, 'potato' => '123456'];
        $this->buildRequestAndTestErrorFieldPresent('items');
    }

    public function testBuildARequestWithInvalidValueBecauseMoreItemsThanAllowedInAssociativeArray()
    {
        $this->request['items'] = ['a' => 56, 'potato' => '12345', 'nope' => 'Nope'];
        $this->buildRequestAndTestErrorFieldPresent('items');
    }

    public function testBuildARequestWithValidValueInAssociativeArray()
    {
        $this->request['items'] = ['a' => 56, 'potato' => '12345'];
        $this->assertRequestParsesCorrectly();
    }
}
