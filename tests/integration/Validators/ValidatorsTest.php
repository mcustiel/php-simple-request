<?php

namespace Integration\Validators;

use Fixtures\AllValidatorsRequest;
use Mcustiel\SimpleRequest\RequestBuilder;
use Mcustiel\SimpleRequest\ParserResponse;

class ValidatorsTest extends AbstractValidatorTest
{
    public function testBuildARequestAndValidators()
    {
        $this->assertRequestParsesCorrectly();
    }
}
