<?php
namespace Integration\Validators;

class NotNullTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValueBecauseItsNull()
    {
        $this->request['notNull'] = null;
        $this->buildRequestAndTestErrorFieldPresent('notNull');
    }

    public function testBuildARequestWithInvalidValueBecauseItsNotSet()
    {
        unset($this->request['notNull']);
        $this->buildRequestAndTestErrorFieldPresent('notNull');
    }
}
