<?php
namespace Integration\Validators;

class TwitterTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidValue()
    {
        $this->request['twitterAccount'] = 'pepe';
        $this->buildRequestAndTestErrorFieldPresent('twitterAccount');
    }

}
