<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\Date;

class DateValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationDefaultSpecification()
    {
        $validator = new Date();

        $this->assertTrue($validator->validate('1981-10-17T01:30:00+0000'));
        $this->assertTrue($validator->validate('1981-10-17T01:30:00+00:00'));
        $this->assertFalse($validator->validate('1981-10-17 01:30:00+0000'));
        $this->assertFalse($validator->validate('1981-10-17 01:30:00'));
        $this->assertFalse($validator->validate('1981-10-17 01:30'));
        $this->assertFalse($validator->validate('1981-10-17 01'));
        $this->assertFalse($validator->validate('1981-10-17'));
    }

    public function testValidationStrict()
    {
        $validator = new Date();
        $validator->setSpecification(\DateTime::ATOM);

        $this->assertTrue($validator->validate('1981-10-17T01:30:00+0000'));
        $this->assertTrue($validator->validate('1981-10-17T01:30:00+00:00'));
        $this->assertFalse($validator->validate('1981-10-17 01:30:00+0000'));
        $this->assertFalse($validator->validate('1981-10-17 01:30:00'));
        $this->assertFalse($validator->validate('1981-10-17 01:30'));
        $this->assertFalse($validator->validate('1981-10-17 01'));
        $this->assertFalse($validator->validate('1981-10-17'));
    }
}
