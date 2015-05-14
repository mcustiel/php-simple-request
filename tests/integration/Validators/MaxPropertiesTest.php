<?php
namespace Integration\Validators;

class MaxPropertiesTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'maxProperties';

    public function testBuildARequestWithInvalidValueBecauseOverMaxPropertiesInArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a', 'b', 'c', 'nope' ];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseOverMaxPropertiesInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c', 'nope' => 'Nope' ];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueInArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a', 'b', 'c' ];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithValidValueInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a' => 'a', 'b' => 'b', 'c' => 'c' ];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValueBecauseOverMaxPropertiesInObject()
    {
        $class = $this->getStdClassWithTwoProperties();
        $class->nope = 'nope';

        $this->request[self::TEST_FIELD] = $class;
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithValidValueInObject()
    {
        $class = $this->getStdClassWithTwoProperties();

        $this->request[self::TEST_FIELD] = $class;
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

