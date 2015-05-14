<?php
namespace Integration\Validators;

class FloatTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValueBecauseOfStrict()
    {
        $this->request['float'] = '5';
        $this->buildRequestAndTestErrorFieldPresent('float');
    }

    public function testBuildARequestWithInvalidValueBecauseOfNotNumeric()
    {
        $this->request['float'] = 'nope';
        $this->buildRequestAndTestErrorFieldPresent('float');
    }
}
