<?php
namespace Integration\Validators;

class MaxLengthTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidMaxLength()
    {
        $this->request['maxLength'] = '123456';
        $this->buildRequestAndTestErrorFieldPresent('maxLength');
    }
}
