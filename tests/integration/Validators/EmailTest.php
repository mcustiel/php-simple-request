<?php
namespace Integration\Validators;

class EmailTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidEmail()
    {
        $this->request['email'] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent('email');
    }
}
