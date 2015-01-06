<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\Float;

class FloatValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new Float();

        $this->assertTrue($validator->validate('1.1'));
        $this->assertTrue($validator->validate(1.1));
        $this->assertTrue($validator->validate(1));
        $this->assertTrue($validator->validate(0));
        $this->assertTrue($validator->validate(0.0));
        $this->assertTrue($validator->validate('0.0'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('a'));
        $this->assertFalse($validator->validate([]));
        $this->assertFalse($validator->validate([1.1]));
    }

    public function testValidationStrict()
    {
        $validator = new Float();
        $validator->setSpecification(true);

        $this->assertTrue($validator->validate('1.1'));
        $this->assertTrue($validator->validate(1.1));
        $this->assertFalse($validator->validate(1));
        $this->assertFalse($validator->validate(0));
        $this->assertTrue($validator->validate(0.0));
        $this->assertTrue($validator->validate('0.0'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('a'));
        $this->assertFalse($validator->validate([]));
        $this->assertFalse($validator->validate([1.1]));
    }
}
