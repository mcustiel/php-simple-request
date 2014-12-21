<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\NotEmpty;

class NotEmptyValidatorTest extends \PHPUnit_Framework_TestCase
{
    const EMPTY_STRING = '';
    const ALL_SPACES_STRING = '   ';
    const NOT_EMPTY_STRING = 'A';

    public function testValidationDefaultSpecification()
    {
        $validator = new NotEmpty();
        $this->assertFalse($validator->validate(self::EMPTY_STRING));
        $this->assertTrue($validator->validate(self::ALL_SPACES_STRING));
        $this->assertTrue($validator->validate(self::NOT_EMPTY_STRING));
    }

    public function testValidationSpecifiedValueTrue()
    {
        $validator = new NotEmpty();
        $validator->setSpecification(true);
        $this->assertFalse($validator->validate(self::EMPTY_STRING));
        $this->assertFalse($validator->validate(self::ALL_SPACES_STRING));
        $this->assertTrue($validator->validate(self::NOT_EMPTY_STRING));
    }
}
