<?php
namespace Integration\Validators;

class PropertiesTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidItemsBecauseOneItemDoesNotPass()
    {
        $this->request['properties'] = ['key1' => 56, 'key2' => '123456'];
        $this->buildRequestAndTestErrorFieldPresent('properties');
    }

    public function testBuildARequestWithInvalidItemsBecauseMoreItemsThanAllowed()
    {
        $this->request['properties'] = ['key1' => 56, 'key2' => '12345', 'key3' => 'Nope'];
        $this->buildRequestAndTestErrorFieldPresent('properties');
    }
}
