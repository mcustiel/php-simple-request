<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\MultipleOf;

class MultipleOfTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new MultipleOf();
    }

    public function testValidationWithIntegerValueAndIntegerSpecification()
    {
        $this->validator->setSpecification(5);
        $this->assertTrue($this->validator->validate(25));
        $this->assertFalse($this->validator->validate(23));
    }

    public function testValidationWithFloatValueAndIntegerSpecification()
    {
        $this->validator->setSpecification(5);
        $this->assertTrue($this->validator->validate(25.0));
        $this->assertFalse($this->validator->validate(25.2));
    }

    public function testValidationWithIntegerValueAndFloatSpecification()
    {
        $this->validator->setSpecification(2.5);
        $this->assertTrue($this->validator->validate(5));
        $this->assertFalse($this->validator->validate(13));
    }

    public function testValidationWithFloatValueAndFloatSpecification()
    {
        $this->validator->setSpecification(2.5);
        $this->assertTrue($this->validator->validate(5.0));
        $this->assertFalse($this->validator->validate(5.5));
    }
}
