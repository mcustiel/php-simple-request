<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\Alpha;

class AlphaValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationSuccessful()
    {
        $validator = new Alpha();

        $this->assertTrue($validator->validate('AaBbCc'));
        $this->assertFalse($validator->validate('Aa Bb Cc'));
        $this->assertFalse($validator->validate('Aa1Bb2Cc'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('123'));
        $this->assertFalse($validator->validate('---'));
        $this->assertFalse($validator->validate('   '));
    }
}
