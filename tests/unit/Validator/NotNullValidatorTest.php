<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\NotNull;

class NotNullValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new NotNull();
        $this->assertTrue($validator->validate(''));
        $this->assertTrue($validator->validate([]));
        $this->assertFalse($validator->validate(null));
        $this->assertTrue($validator->validate(0));
        $this->assertTrue($validator->validate('0'));
        $this->assertTrue($validator->validate(0.0));
        $this->assertTrue($validator->validate(false));
    }
}
