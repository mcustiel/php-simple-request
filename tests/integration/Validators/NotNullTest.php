<?php
namespace Integration\Validators;

class NotNullTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidNotNullBecauseItsNull()
    {
        $this->request['notNull'] = null;
        $this->buildRequestAndTestErrorFieldPresent('notNull');
    }

    public function testBuildARequestWithInvalidNotNullBecauseItsNotSet()
    {
        unset($this->request['notNull']);
        $this->buildRequestAndTestErrorFieldPresent('notNull');
    }
}
