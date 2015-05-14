<?php
namespace Integration\Validators;

class AnyOfTest extends AbstractValidatorTest
{
    public function testBuildARequestWithValidAnyOfBecauseOneOfTheValidatorsValidates()
    {
        $this->request['anyOf'] = 5;
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithValidAnyOfBecauseTheOtherOfTheValidatorsValidates()
    {
        $this->request['anyOf'] = '192.168.0.1';
        $this->assertRequestParsesCorrectly();
    }

    public function testBuildARequestWithInvalidValue()
    {
        $this->request['anyOf'] = 'potato';
        $this->assertRequestParsesCorrectly();
    }
}
