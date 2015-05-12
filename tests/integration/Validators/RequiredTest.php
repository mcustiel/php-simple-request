<?php
namespace Integration\Validators;

class RequiredTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidRequiredInAStdClass()
    {
        $class = new \stdClass();
        $class->key1 = 'val1';
        $class->key3 = 'val3';

        $this->request['required'] = $class;
        $this->buildRequestAndTestErrorFieldPresent('required');
    }

    public function testBuildARequestWithValidArray()
    {
        $this->request['required'] = ['key1' => 'val1', 'key2' => 'val2', 'key3' => 'val3'];
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidRequestInAnArray()
    {
        $this->request['required'] = ['key1' => 'val1', 'key3' => 'val3'];
        $this->buildRequestAndTestErrorFieldPresent('required');
    }
}
