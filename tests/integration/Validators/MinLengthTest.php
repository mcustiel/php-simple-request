<?php
namespace Integration\Validators;

class MinLengthTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidMinLength()
    {
        $this->request['minLength'] = '1';
        $this->buildRequestAndTestErrorFieldPresent('minLength');
    }
}
