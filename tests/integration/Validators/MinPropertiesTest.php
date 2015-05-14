<?php
namespace Integration\Validators;

class MinPropertiesTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'minProperties';

    public function testBuildARequestWithInvalidValueBecauseUnderMinPropertiesInArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a', 'b' ];
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

    public function testBuildARequestWithInvalidValueBecauseUnderMinPropertiesInAssociativeArray()
    {
        $this->request[self::TEST_FIELD] = [ 'a' => 'a', 'b' => 'b' ];
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

    public function testBuildARequestWithInvalidValueBecauseUnderMinPropertiesInObject()
    {
        $class = $this->getStdClassWithTwoProperties();
        unset($class->c);

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

