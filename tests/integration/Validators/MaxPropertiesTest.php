<?php
namespace Integration\Validators;

class MaxPropertiesTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValueBecauseOverMaxPropertiesInArray()
    {
        $this->request['maxProperties'] = [ 'a', 'b', 'c', 'nope' ];
        $this->buildRequestAndTestErrorFieldPresent('maxProperties');
    }

    public function testBuildARequestWithInvalidValueBecauseOverMaxPropertiesInAssociativeArray()
    {
        $this->request['maxProperties'] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c', 'nope' => 'Nope' ];
        $this->buildRequestAndTestErrorFieldPresent('maxProperties');
    }

    public function testBuildARequestWithValidValueInArray()
    {
        $this->request['maxProperties'] = [ 'a', 'b', 'c' ];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithValidValueInAssociativeArray()
    {
        $this->request['maxProperties'] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c' ];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueBecauseOverMaxPropertiesInObject()
    {
        $class = $this->getStdClassWithTwoProperties();
        $class->nope = 'nope';

        $this->request['maxProperties'] = $class;
        $this->buildRequestAndTestErrorFieldPresent('maxProperties');
    }

    public function testBuildARequestWithValidValueInObject()
    {
        $class = $this->getStdClassWithTwoProperties();

        $this->request['maxProperties'] = $class;
        $this->assertRequestParsesCorrectly();
    }

    private function getStdClassWithTwoProperties()
    {
        $object = new \stdClass();
        $object->a = 'a';
        $object->b = 'b';
        $object->c = 'c';

        return $object;
    }
}

