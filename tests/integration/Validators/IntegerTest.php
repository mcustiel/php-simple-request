<?php
namespace Integration\Validators;

class IntegerTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidInteger()
    {
        $this->request['integer'] = 'nope';
        $this->buildRequestAndTestErrorFieldPresent('integer');
    }
}
