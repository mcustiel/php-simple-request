<?php
namespace Integration\Validators;

class NotEmptyTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidNotEmpty()
    {
        $this->request['notEmpty'] = '';
        $this->buildRequestAndTestErrorFieldPresent('notEmpty');
    }
}
