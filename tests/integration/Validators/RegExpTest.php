<?php
namespace Integration\Validators;

class RegExpTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidRegExp()
    {
        $this->request['regExp'] = '123abc';
        $this->buildRequestAndTestErrorFieldPresent('regExp');
    }
}
