<?php
namespace Integration\Validators;

class MinLengthTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['minLength'] = '1';
        $this->buildRequestAndTestErrorFieldPresent('minLength');
    }
}
