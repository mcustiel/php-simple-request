<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\Email;

class EmailValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new Email();
        $validator->setSpecification(null);

        $this->assertTrue($validator->validate('pipicui@hotmail.com'));
        $this->assertFalse($validator->validate('mailto:pipicui@hotmail.com'));
        $this->assertFalse($validator->validate('1981-10-17T01:30:00+00:00'));
        $this->assertFalse($validator->validate('mail'));
        $this->assertFalse($validator->validate('@server'));
        $this->assertFalse($validator->validate('server.com'));
        $this->assertFalse($validator->validate('.com'));
        $this->assertFalse($validator->validate(''));
    }
}
