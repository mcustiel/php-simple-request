<?php
namespace Unit\Validator;

use Mcustiel\SimpleRequest\Validator\RegExp;

class RegExpValidatorTest extends \PHPUnit_Framework_TestCase
{
    const VALID_REGEXP = '/[A-Z][0-9]{2}/i';
    const VALID_VALUE = 'b12';
    const INVALID_VALUE = 'A';

    /**
     * @expectedException        \Mcustiel\SimpleRequest\Exception\UnspecifiedValidatorException
     * @expectedExceptionMessage The validator RegExp is being initialized without a specified regular expression
     */
    public function testSpecificationWithoutValue()
    {
        $validator = new RegExp();
        $validator->setSpecification();
    }

    public function testValidationWithValidValue()
    {
        $validator = new RegExp();
        $validator->setSpecification(self::VALID_REGEXP);
        $this->assertTrue($validator->validate(self::VALID_VALUE));
    }

    public function testValidationWithInvalidValue()
    {
        $validator = new RegExp();
        $validator->setSpecification(self::VALID_REGEXP);
        $this->assertFalse($validator->validate(self::INVALID_VALUE));
    }
}
