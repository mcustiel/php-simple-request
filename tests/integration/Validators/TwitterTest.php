<?php
namespace Integration\Validators;

class TwitterTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidTwitterAccount()
    {
        $this->request['twitterAccount'] = 'pepe';
        $this->buildRequestAndTestErrorFieldPresent('twitterAccount');
    }

}
