<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\Float;

class FloatValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new Float();
    }

    public function testValidationDefaultSpecification()
    {
        $this->assertTrue($this->validator->validate('1.1'));
        $this->assertTrue($this->validator->validate(1.1));
        $this->assertTrue($this->validator->validate(1));
        $this->assertTrue($this->validator->validate(0));
        $this->assertTrue($this->validator->validate(0.0));
        $this->assertTrue($this->validator->validate('0.0'));
        $this->assertFalse($this->validator->validate(''));
        $this->assertFalse($this->validator->validate('a'));
        $this->assertFalse($this->validator->validate([]));
        $this->assertFalse($this->validator->validate([1.1]));
    }

    public function testValidationStrict()
    {
        $this->validator->setSpecification(true);

        $this->assertTrue($this->validator->validate('1.1'));
        $this->assertTrue($this->validator->validate(1.1));
        $this->assertFalse($this->validator->validate(1));
        $this->assertFalse($this->validator->validate(0));
        $this->assertTrue($this->validator->validate(0.0));
        $this->assertTrue($this->validator->validate('0.0'));
        $this->assertFalse($this->validator->validate(''));
        $this->assertFalse($this->validator->validate('a'));
        $this->assertFalse($this->validator->validate([]));
        $this->assertFalse($this->validator->validate([1.1]));
    }
}
