<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\IPV6;

class IPV6ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new IPV6();
        $validator->setSpecification(null);



        $this->assertFalse($validator->validate('1'));
        $this->assertFalse($validator->validate('1:1'));
        $this->assertFalse($validator->validate('1:1:1'));
        $this->assertFalse($validator->validate('1:1:1:1'));
        $this->assertFalse($validator->validate('1:1:1:1:1'));
        $this->assertFalse($validator->validate('1:1:1:1:1:1'));
        $this->assertFalse($validator->validate('1:1:1:1:1:1:1'));
        $this->assertTrue($validator->validate('1:1:1:1:1:1:1:1'));
        $this->assertTrue($validator->validate('01:01:01:01:01:01:01:01'));
        $this->assertTrue($validator->validate('001:001:001:001:001:001:001:001'));
        $this->assertTrue($validator->validate('0001:0001:0001:0001:0001:0001:0001:0001'));
        $this->assertTrue($validator->validate('A001:A001:A001:A001:A001:A001:A001:A001'));
        $this->assertTrue($validator->validate('a001:a001:a001:0001:a001:a001:a001:a001'));
        $this->assertTrue($validator->validate('A001:a001:A001:a001:A001:a001:A001:a001'));
        $this->assertTrue($validator->validate('::A000:A000'));
        $this->assertTrue($validator->validate('A000::A000'));
        $this->assertTrue($validator->validate('A000:A000:A000::A000:A000'));
        $this->assertTrue($validator->validate('A000:A000::A000:A000:A000'));
        $this->assertTrue($validator->validate('A000:A000::'));
        $this->assertFalse($validator->validate('A000:A000:A000:A000:A000:A000:A000:A000:A000'));
        $this->assertFalse($validator->validate('::A000:A000:A000:A000:A000:A000:A000:A000'));
        $this->assertFalse($validator->validate('A000:A000:A000:A000:A000:A000:A000:A000::'));
        $this->assertFalse($validator->validate('A000:A000:A000:A000::A000:A000:A000:A000'));
        $this->assertFalse($validator->validate('A000:A000:A000:A000:A000:A000:A000:G000'));
        $this->assertFalse($validator->validate('10.10.10.10'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('a'));
        $this->assertFalse($validator->validate([]));
        $this->assertFalse($validator->validate(['1.1.1.1']));
    }
}
