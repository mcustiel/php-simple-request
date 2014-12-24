<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\MinLength;

class MinLengthValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new MinLength();
        $this->assertTrue($validator->validate(''));
        $this->assertTrue($validator->validate(''));
        $this->assertTrue($validator->validate("AAAAAAAA"));
    }

    public function testValidationSpecifiedValue()
    {
        $validator = new MinLength();
        $validator->setSpecification(5);
        $this->assertTrue($validator->validate('12345678901234567890123456789012345678901234567890'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('a'));
        $this->assertFalse($validator->validate('aa'));
        $this->assertFalse($validator->validate('aaa'));
        $this->assertFalse($validator->validate('aaaa'));
        $this->assertTrue($validator->validate('aaaaa'));
    }
}
