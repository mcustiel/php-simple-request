<?php
namespace Integration\Validators;

class UrlTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['url'] = '-:ht:/s//1234.p,s';
        $this->buildRequestAndTestErrorFieldPresent('url');
    }
}
