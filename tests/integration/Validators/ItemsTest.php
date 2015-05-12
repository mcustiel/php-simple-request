<?php
namespace Integration\Validators;

class ItemsTest extends AbstractValidatorTest
{
    public function testBuildARequestWithInvalidItemsBecauseOneItemDoesNotPass()
    {
        $this->request['items'] = [56, '123456'];
        $this->buildRequestAndTestErrorFieldPresent('items');
    }

    public function testBuildARequestWithInvalidItemsBecauseMoreItemsThanAllowed()
    {
        $this->request['items'] = [56, '12345', 'Nope'];
        $this->buildRequestAndTestErrorFieldPresent('items');
    }
}
