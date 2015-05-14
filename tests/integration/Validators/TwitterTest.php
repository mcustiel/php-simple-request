<?php
namespace Integration\Validators;

class TwitterTest extends AbstractValidatorTest
{
    const TEST_FIELD = 'twitterAccount';

    public function testBuildARequestWithInvalidValue()
    {
        $this->request[self::TEST_FIELD] = 'pepe';
        $this->buildRequestAndTestErrorFieldPresent(self::TEST_FIELD);
    }

}
