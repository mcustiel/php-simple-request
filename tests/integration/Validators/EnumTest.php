<?php
namespace Integration\Validators;

class EnumTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['enum'] = 'potato';
        $this->buildRequestAndTestErrorFieldPresent('enum');
    }
}
