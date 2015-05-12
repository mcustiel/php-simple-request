<?php
namespace Integration\Validators;

class CustomValidatorTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidCustom()
    {
        $this->request['custom'] = '0.5';
        $this->buildRequestAndTestErrorFieldPresent('custom');
    }
}
