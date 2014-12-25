<?php
namespace Unit\SimpleRequest\Validator;

use Mcustiel\SimpleRequest\Validator\MaxLength;

class MaxLengthValidatorTest extends \PHPUnit_Framework_TestCase
{
    const STRING_WITH_LENGTH_255 = '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345';
    const STRING_WITH_LENGTH_50 = '12345678901234567890123456789012345678901234567890';


    public function testValidationDefaultSpecification()
    {
        $validator = new MaxLength();
        $this->assertTrue($validator->validate(self::STRING_WITH_LENGTH_50));
        $this->assertTrue($validator->validate(''));
        $this->assertTrue($validator->validate(self::STRING_WITH_LENGTH_255));
        $this->assertFalse($validator->validate(self::STRING_WITH_LENGTH_255 . 'A'));
    }

    public function testValidationSpecifiedValue()
    {
        $validator = new MaxLength();
        $validator->setSpecification(50);
        $this->assertTrue($validator->validate('12345678901234567890123456789012345678901234567890'));
        $this->assertTrue($validator->validate(''));
        $this->assertTrue($validator->validate(self::STRING_WITH_LENGTH_50));
        $this->assertFalse($validator->validate(self::STRING_WITH_LENGTH_50 . 'A'));
        $this->assertTrue($validator->validate([]));
        $this->assertTrue($validator->validate(['a']));
        $this->assertTrue($validator->validate(str_split(self::STRING_WITH_LENGTH_50)));
        $this->assertFalse($validator->validate(str_split(self::STRING_WITH_LENGTH_50 . 'A')));
    }
}
