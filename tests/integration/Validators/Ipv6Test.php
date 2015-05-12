<?php
namespace Integration\Validators;

class Ipv6Test extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidIpv6()
    {
        $this->request['ipv6'] = '2001:0db8:85a3:08d3:1319:8a2e:0370:733g';
        $this->buildRequestAndTestErrorFieldPresent('ipv6');
    }
}
