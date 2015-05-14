<?php
namespace Integration\Validators;

class IntegerTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['integer'] = 'nope';
        $this->buildRequestAndTestErrorFieldPresent('integer');
    }

    public function testBuildARequestWithValidValueInFloatFormat()
    {
        $this->request['integer'] = 1.0;
        $this->assertRequestParsesCorrectly();
    }
}
