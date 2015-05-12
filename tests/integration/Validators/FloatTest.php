<?php
namespace Integration\Validators;

class FloatTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidFloatBecauseOfStrict()
    {
        $this->request['float'] = '5';
        $this->buildRequestAndTestErrorFieldPresent('float');
    }

    public function testBuildARequestWithInvalidFloatBecauseOfNotNumeric()
    {
        $this->request['float'] = 'nope';
        $this->buildRequestAndTestErrorFieldPresent('float');
    }
}
