<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\AlphaNumeric;

class AlphaNumericValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationSuccessful()
    {
        $validator = new AlphaNumeric();

        $this->assertTrue($validator->validate('AaBbCc'));
        $this->assertTrue($validator->validate('Aa1Bb2Cc'));
        $this->assertTrue($validator->validate('123'));
        $this->assertFalse($validator->validate('Aa Bb Cc'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('---'));
        $this->assertFalse($validator->validate('   '));
    }
}
