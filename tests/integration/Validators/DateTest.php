<?php
namespace Integration\Validators;

class DateTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['date'] = '1981-10-17 01:30:00';
        $this->buildRequestAndTestErrorFieldPresent('date');
    }
}
