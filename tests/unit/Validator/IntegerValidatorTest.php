<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\Integer;

class IntegerValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new Integer();
    }

    public function testValidationDefaultSpecification()
    {
        $this->assertFalse($this->validator->validate('1.1'));
        $this->assertFalse($this->validator->validate(1.1));
        $this->assertTrue($this->validator->validate(1.0));
        $this->assertTrue($this->validator->validate(1));
        $this->assertTrue($this->validator->validate(-1));
        $this->assertTrue($this->validator->validate(0));
        $this->assertTrue($this->validator->validate('0'));
        $this->assertTrue($this->validator->validate('1.0'));
        $this->assertTrue($this->validator->validate('-1'));
        $this->assertFalse($this->validator->validate(''));
        $this->assertFalse($this->validator->validate('a'));
        $this->assertFalse($this->validator->validate([]));
        $this->assertFalse($this->validator->validate([1]));
    }

    public function testValidationStrictSpecification()
    {
        $this->validator->setSpecification(true);

        $this->assertFalse($this->validator->validate('1.1'));
        $this->assertFalse($this->validator->validate(1.1));
        $this->assertFalse($this->validator->validate(1.0));
        $this->assertTrue($this->validator->validate(1));
        $this->assertTrue($this->validator->validate(-1));
        $this->assertTrue($this->validator->validate(0));
        $this->assertTrue($this->validator->validate('0'));
        $this->assertFalse($this->validator->validate('1.0'));
        $this->assertTrue($this->validator->validate('-1'));
        $this->assertFalse($this->validator->validate(''));
        $this->assertFalse($this->validator->validate('a'));
        $this->assertFalse($this->validator->validate([]));
        $this->assertFalse($this->validator->validate([1]));
    }
}
