<?php
namespace Integration\Validators;

class CustomValidatorTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['custom'] = '0.5';
        $this->buildRequestAndTestErrorFieldPresent('custom');
    }
}
