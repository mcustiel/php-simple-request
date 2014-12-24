<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\Integer;

class IntegerValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new Integer();

        $this->assertFalse($validator->validate('1.1'));
        $this->assertFalse($validator->validate(1.1));
        $this->assertTrue($validator->validate(1));
        $this->assertTrue($validator->validate(-1));
        $this->assertTrue($validator->validate(0));
        $this->assertTrue($validator->validate('0'));
        $this->assertTrue($validator->validate('-1'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('a'));
        $this->assertFalse($validator->validate([]));
        $this->assertFalse($validator->validate([1]));
    }
}
