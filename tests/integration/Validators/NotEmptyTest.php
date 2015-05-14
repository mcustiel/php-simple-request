<?php
namespace Integration\Validators;

class NotEmptyTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['notEmpty'] = '';
        $this->buildRequestAndTestErrorFieldPresent('notEmpty');
    }
}
