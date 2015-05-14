<?php
namespace Integration\Validators;

class MaxItemsTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValueBecauseOverMaxItems()
    {
        $this->request['maxItems'] = [ 'a', 'b', 'c', 'nope' ];
        $this->buildRequestAndTestErrorFieldPresent('maxItems');
    }

    public function testBuildARequestWithValidValueBecauseEqualToMaxProperties()
    {
        $this->request['maxProperties'] = [ 'a', 'b', 'c' ];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueBecauseOverMaxItemsInAssociativeArray()
    {
        $this->request['maxItems'] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c', 'nope' => 'Nope' ];
        $this->buildRequestAndTestErrorFieldPresent('maxItems');
    }

    public function testBuildARequestWithValidValueBecauseEqualToMaxPropertiesInAssociativeArray()
    {
        $this->request['maxProperties'] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c' ];
        $this->assertRequestParsesCorrectly();
    }
}
