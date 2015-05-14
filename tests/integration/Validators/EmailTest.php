<?php
namespace Integration\Validators;

class EmailTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['email'] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent('email');
    }
}
