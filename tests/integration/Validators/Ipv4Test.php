<?php
namespace Integration\Validators;

class Ipv4Test extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidIpv4()
    {
        $this->request['ipv4'] = '192.256.0.1';
        $this->buildRequestAndTestErrorFieldPresent('ipv4');
    }
}
