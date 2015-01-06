<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\IPV4;

class IPV4ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new IPV4();
        $validator->setSpecification(null);

        $this->assertFalse($validator->validate('1'));
        $this->assertFalse($validator->validate('1.1'));
        $this->assertFalse($validator->validate('1.1.1'));
        $this->assertTrue($validator->validate('1.1.1.1'));
        $this->assertTrue($validator->validate('10.10.10.10'));
        $this->assertTrue($validator->validate('100.100.100.100'));
        $this->assertFalse($validator->validate('1.1.1.1.1'));
        $this->assertFalse($validator->validate('1.1.1.256'));
        $this->assertTrue($validator->validate('1.1.1.255'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('a'));
        $this->assertFalse($validator->validate([]));
        $this->assertFalse($validator->validate(['1.1.1.1']));
    }
}
