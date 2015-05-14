<?php
namespace Integration\Validators;

class MaxLengthTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['maxLength'] = '123456';
        $this->buildRequestAndTestErrorFieldPresent('maxLength');
    }
}
