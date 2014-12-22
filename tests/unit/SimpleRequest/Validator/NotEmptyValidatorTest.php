<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\NotEmpty;

class NotEmptyValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new NotEmpty();
        $this->assertFalse($validator->validate(''));
        $this->assertTrue($validator->validate('A'));
        $this->assertFalse($validator->validate([]));
        $this->assertTrue($validator->validate([1]));
        $this->assertFalse($validator->validate(null));
        $this->assertFalse($validator->validate(0));
        $this->assertFalse($validator->validate('0'));
        $this->assertFalse($validator->validate(0.0));
        $this->assertFalse($validator->validate(false));
        $this->assertTrue($validator->validate(1));
        $this->assertTrue($validator->validate(1.0));
        $this->assertTrue($validator->validate(true));
    }
}
