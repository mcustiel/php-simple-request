<?php
namespace Integration\Validators;

class RegExpTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['regExp'] = '123abc';
        $this->buildRequestAndTestErrorFieldPresent('regExp');
    }
}
